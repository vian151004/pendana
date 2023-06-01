@push('css_vendor')
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@push('scripts_vendor')
<script src="{{ asset('/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush

@push('scripts')
<script>
    $('.datepicker').datetimepicker({
        icons: {time: 'far fa-clock'},
        format: 'YYYY-MM-DD',
        allowInputToggle: true,
        locale: 'id'
    });

    $('.datetimepicker').datetimepicker({
        icons: {time: 'far fa-clock'},
        format: 'YYYY-MM-DD HH:mm',
        allowInputToggle: true,
        locale: 'id'
    });

</script>
@endpush