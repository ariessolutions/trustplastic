<div class="col-xl-12">
    @if (session()->has('code'))
    <div class="alert alert-{{ session()->get('color') }}">
        <small>{{ session()->get('msg') }}</small>
    </div>
    @endif
</div>
