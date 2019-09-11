{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', 'Login')

@section('org_css')
<link href="/css/home.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<h1 style="display:none;">Log in?
@isset($message)
  <p style="color:red">{{$message}}</p>
@endisset
<form name="loginform" action="/auth/login" method="post">
  {{ csrf_field()}}
  <small>e-Mail:<br /><input type="text" name="email" size="30" value="{{ old("email") }}"></small><br />
  <small>Password:<br /><input type="password" name="password" size="30" ><br /></small>
  <button type="submit" name="action" value="send" class="btn btn-primary">send</button>
  <a href="/">
    <button type="button" class="btn btn-danger">back</button> 
  </a>
</form>
</h1>
<div class="slideshow">
  <div class="slideshow-image-none" style="background-image: url('/images/bicycle-blue-bricks-1149601-min.jpg')"></div>
</div>

<script src="/js/menu.js"></script>
@endsection
