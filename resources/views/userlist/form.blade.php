@extends('layouts.app')

@section('content')

<div id="app">
    <user-form
        scope="{{$scope}}"
        :id="{{$id ?? 0}}"
    ></user-form>
</div>

@endsection