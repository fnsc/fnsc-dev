@extends('../base')
@section('location')
    {{ $location }}
@endsection
@section('content')
    <div class="container">
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
    </div>
@endsection
