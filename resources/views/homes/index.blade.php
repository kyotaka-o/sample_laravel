{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', 'Home')

@section('org_css')
<link href="/css/home.css" rel="stylesheet" type="text/css">
@endsection

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
<h1><small>Cycling'photos</small> 
  Enjoy Cycling? 
  <small>
    <a href="/auth/login">
      <button type="button" class="btn btn-primary">log in?</button> 
    </a>
    <a href="/auth/register">
      <button type="button" class="btn btn-success">sign up?</button>
    </a>
  </small>
</h1>

<!-- You can add more ".slideshow-image" elements, but remember to update the "$items" variable on SCSS -->
<div class="slideshow">
  <div class="slideshow-image" style="background-image: url('/images/bicycles-bikers-black-and-white-270214.jpg')"></div>
  <div class="slideshow-image" style="background-image: url('/images/adventure-bicycle-cycling-161172.jpg')"></div>
  <div class="slideshow-image" style="background-image: url('/images/athlete-bicycle-bicyclist-15765.jpg')"></div>
  <div class="slideshow-image" style="background-image: url('/images/bicycle-blue-bricks-1149601.jpg')"></div>
</div>

@endsection