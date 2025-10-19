@extends('layouts.landing')

@section('title', 'SIMA')

@section('content')
    <main>
        @include('partials.landing.home')
        @include('partials.landing.about')
        @include('partials.landing.contact')
    </main>
@endsection