@extends('../base')
@section('location')
    {{ $location }}
@endsection
@section('content')
    <container-component
        :user="{{ json_encode($user) }}"
        :social_media="{{ json_encode($socialMedia) }}"
        :heart="{{ json_encode($icons['heart']) }}"
    ></container-component>
@endsection
