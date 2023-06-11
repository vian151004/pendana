<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = array (
            0 => array (
                'name' => 'BANK BRI',
                'code' => '002',   
                'path_image' => '/storage/bank/BRI.png'                     
            ),
            1 => array (
                'name' => 'BANK BNI',
                'code' => '009',    
                'path_image' => '/storage/bank/BNI.png'                   
            ),
            2 => array (
                'name' => 'BANK BCA',
                'code' => '014', 
                'path_image' => '/storage/bank/BCA.png'                      
            )
        );

        collect($bank)->map(function ($v) {
            Bank::query()
                ->updateOrCreate(
                    [
                        'code' => $v['code']
                    ],
                    [
                        'code' => $v['code'],
                        'name' => $v['name'],
                        'path_image' => $v['path_image'],
                    ]
                );
        });
    }
}
