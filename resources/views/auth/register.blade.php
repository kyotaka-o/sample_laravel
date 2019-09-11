
{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

{{-- @yield('title')にテンプレートごとの値を代入 --}}
@section('title', 'Signup')

@section('org_css')
<link href="/css/home.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<h1 style="display:none;">Sign up?
<form name="registform" action="/auth/register" method="post">
  {{ csrf_field()}}
  <small>name:<br /><input type="text" name="name" size="30" ><span>{{ $errors->first("name") }}</span></small><br />
  <small>e-mail:<br /><input type="text" name="email" size="30" ><span>{{ $errors->first("email") }}</span></small><br />
  <small>password:<br /><input type="password" name="password" size="30" ><span>{{ $errors->first("password") }}</span></small><br />
  <small>password(confirm):<br /><input type="password" name="password_confirmation" size="30" ><span>{{ $errors->first("password_confirmation") }}</span></small><br />
  <button type="submit" name="action" value="send" class="btn btn-success">send</button>
  <a href="/">
    <button type="button" class="btn btn-danger">back</button> 
  </a>
</form>
</h1>
<div class="slideshow">
  <div class="slideshow-image-none" style="background-image: url('/images/adventure-bicycle-cycling-161172-min.jpg')"></div>
</div>
<script src="/js/menu.js"></script>
@endsection
