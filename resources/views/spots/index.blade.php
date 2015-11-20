@extends('layouts.app')

@section('content')

    @foreach($spots as $spot)
        <h2>{{ $spot->name }}</h2>
    @endforeach

@endsection
