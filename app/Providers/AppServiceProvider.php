<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Cashout;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Donation;
use App\Models\Subscriber;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('setting', Setting::first());
        });

        view()->composer('layouts.partials.header', function ($view) {
            $listNotifikasi = [
                'donatur' => User::donatur()->whereDate('created_at', Date('Y-m-d'))->get(), //
                'subscriber' => Subscriber::whereDate('created_at', Date('Y-m-d'))->get(), //
                'contact' => Contact::whereDate('created_at', Date('Y-m-d'))->get(), //
                'donation' => Donation::whereDate('created_at', Date('Y-m-d'))->get(), //where('status', 'not confirmed')->
                'cashout' => Cashout::whereDate('created_at', Date('Y-m-d'))->get() //where('status', 'pending')->
            ];

            if (auth()->user()->hasRole('donatur')) {
                $listNotifikasi = [
                    'donation' => Donation::donatur()->whereDate('created_at', Date('Y-m-d'))->get(), //where('status', 'not confirmed')->
                    'cashout' => Cashout::donatur()->whereDate('created_at', Date('Y-m-d'))->get() //where('status', 'pending')->
                ];
            }
            
            $countNotifikasi = collect($listNotifikasi)->map(fn ($v) => $v->count())->sum();

            $listNotifikasi = collect($listNotifikasi)
                ->map(fn ($v) => $v->push($v->count()))
                ->map(function ($v, $k) {
                    $attributes = $v->sortByDesc('created_at')->first();
                    if ($v->sortByDesc('created_at')->last()) {
                        $attributes->$k = $v->sortByDesc('created_at')->last();
                    }

                    return $attributes;
                })
                ->sortByDesc(fn ($v) => $v->created_at ?? '');

            $view->with([
                'listNotifikasi' => $listNotifikasi,
                'countNotifikasi' => $countNotifikasi
            ]);
        });
    }
}
