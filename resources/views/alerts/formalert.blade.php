<div class="col-xl-12">
    @if (session()->has('code'))
    <div class="alert alert-{{ session()->get('color') }} alert-warning alert-dismissable">
        <small>{{ session()->get('msg') }}</small>
        <a style="text-decoration: none;" href="#" class="close pull-right text-{{ session()->get('color') }}" data-dismiss="alert" aria-label="close">×</a>
    </div>
    @endif
</div>
