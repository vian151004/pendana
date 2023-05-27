@if(isset($k) && isset($model))
    {{ ($k += 1) + ($model->currentPage() * $model->perPage() - $model->perPage()) }}
@endif