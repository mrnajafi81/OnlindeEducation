@extends('layouts.app')

@section('title','سامانه سوالات')

@section('body-contents')
    <h1>سلام به صفحه اصلی خوش آمدید</h1>
    @if(auth()->user())
        {{dump(auth()->user())}}
    @endif
@endsection
