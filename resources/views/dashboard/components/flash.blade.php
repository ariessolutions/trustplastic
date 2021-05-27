<div class="col-xl-12">
    @if (session()->has('code'))
        <div class="alert alert-{{ session()->get('color') }}">
            <small>{{ session()->get('msg') }}</small>
        </div>
    @endif
</div>

{{-- <script>
    @if (session()->has('code'))
        $('#poItemInsert').modal('show');

        showAlert();

    @endif

    function showAlert() {
        alert('Please add items to save purchase order');
    }

</script> --}}

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
