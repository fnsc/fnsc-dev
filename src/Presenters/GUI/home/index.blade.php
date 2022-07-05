@extends('../base')
@section('location')
    {{ $location }}
@endsection
@section('content')
    <div class="container custom-container d-flex flex-column">
        <div class="row">
            <div class="col-12 avatar">
                <img src="{{ secure_asset($user['avatarUrl']) }}" alt="avatar" class="avatar-img img-fluid mx-auto d-block">
            </div>
            <div class="col-12 mt-3">
                <h1 class="text-center">{{ $user['name'] }}</h1>
            </div>
            <div class="col-12 mt-1">
                <p class="text-center">{{ $user['bio'] }}</p>
            </div>
            <div class="col-12 mt-1 text-center">
                @foreach($socialMedia as $socialNetwork)
                <a href="{{ $socialNetwork['profileUrl'] }}" title="{{ $socialNetwork['name'] }}" class="icon-anchor" rel="nofollow">
                    <svg class="img-fluid icon-img">
                        <use xlink:href="{{ $socialNetwork['iconPath'] }}"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        <footer class="row mt-auto p-3">
            <div class="col-12 text-center">
                <span>
                    Made with
                    <svg class="img-fluid heart">
                        <use xlink:href="{{ asset('img/heart.svg') }}#heart"/>
                    </svg>
                    using
                    <a href="https://laravel.com">Laravel</a>.
                    See this project on
                    <a href="https://github.com/fnsc/fnsc-dev">GitHub</a>.
                </span>
            </div>
        </footer>
    </div>
@endsection
