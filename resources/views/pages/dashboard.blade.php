@extends ('layouts.app')

@section ('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-2 sidebar">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">{{ __('Active') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">{{ __('Link') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">{{ __('Link') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">{{ __('Disabled') }}</a>
        </li>
        </ul>
    </div>
    <div class="col-10">
        <div class="container">
            <div class="row">
                <div class="col-12 content">
                    <p>blabla<p>
                <div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
