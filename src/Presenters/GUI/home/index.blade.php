@extends('../base')
@section('location')
    {{ $location }}
@endsection
@section('content')
    <container-component
        :user="{{ json_encode($user) }}"
        :social_media="{{ json_encode($socialMedia) }}"
        :icons="{{ json_encode($icons) }}"
    ></container-component>
@endsection
