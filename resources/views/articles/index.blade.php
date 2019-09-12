
{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.application')

@if (!Auth::check())
  {{-- @yield('title')にテンプレートごとの値を代入 --}}
  @section('title', 'Home')

  @section('org_css')
  <link href="/css/home.css" rel="stylesheet" type="text/css">
  @endsection

  {{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
  @section('content')
<h1 style="display:none;"><small>Cycling's photos</small> 
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
    <div class="slideshow-image" style="background-image: url('/images/bicycles-bikers-black-and-white-270214-min.jpg')"></div>
    <div class="slideshow-image" style="background-image: url('/images/adventure-bicycle-cycling-161172-min.jpg')"></div>
    <div class="slideshow-image" style="background-image: url('/images/athlete-bicycle-bicyclist-15765-min.jpg')"></div>
    <div class="slideshow-image" style="background-image: url('/images/bicycle-blue-bricks-1149601-min.jpg')"></div>
  </div>
  <script src="/js/menu.js"></script>
  @endsection
@else

  {{-- @yield('title')にテンプレートごとの値を代入 --}}
  @section('title', '記事一覧')
  @section('org_css')
  <link href="/css/articles.css" rel="stylesheet" type="text/css">
  <link href="/css/button.css" rel="stylesheet" type="text/css">
  <link href="/css/modal.css" rel="stylesheet" type="text/css">
  <link href="/css/flip.css" rel="stylesheet" type="text/css">
  @endsection
  {{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
  @section('content')
    <h1>Enjoy Cycling?</h1> 
    <div class="art-title">
      <h2>Cycling's photos</h2>
      <span id="directionality">▼</span>
    </div>

    <div class="menu fader">
      <div class="btn trigger">
        <span class="line"></span>
      </div>
      <div class="icons">
        <div class="rotater">
              <button type="button" class="btn btn-icon btn-primary rounded-circle p-0" style="width:4rem;height:4rem;" id="new-art">New</button>  
        </div>
        <div class="rotater">
            <a href="/">
              <button type="button" class="btn btn-icon btn-info rounded-circle p-0" style="width:4rem;height:4rem;">Mypage</button>  
            </a>
        </div>
        <div class="rotater">
            <a href="/">
              <button type="button" class="btn btn-icon btn-success rounded-circle p-0" style="width:4rem;height:4rem;">Users</button>  
            </a>
        </div>
        <div class="rotater">
          <!-- <div class="btn btn-icon"> -->
            <a href="/">
              <button type="button" class="btn btn-icon btn-warning rounded-circle p-0" style="width:4rem;height:4rem;">Config</button>  
            </a>
          <!-- </div> -->
        </div>
        <div class="rotater">
          <!-- <div class="btn btn-icon"> -->
            <a href="/auth/logout">
              <button type="button" class="btn btn-icon btn-danger rounded-circle p-0" style="width:4rem;height:4rem;">Logout</button>  
            </a>
          <!-- </div> -->
        </div>
        <div class="rotater">
          <!-- <div class="btn btn-icon"> -->
            <a href="/">
              <button type="button" class="btn btn-icon btn-secondary rounded-circle p-0" style="width:4rem;height:4rem;">？</button>  
            </a>
          <!-- </div> -->
        </div>
      </div>
    </div>

    <section class="fader">
      @foreach ($articles as $article)
        <div class="art-card" style="background-image: url('/{{ str_replace('public/', 'storage/', $article->image_url)}}')" data-id='{{ $article->id }}'>
          <div class="art-card__title">
            <h4>{{$article->title}}</h4>
          </div>
          <div class="art-card__body">
             <p>{{$article->body}}</p>
          </div>
          @if (Auth::user()->id == $article->user_id)
            <form action="/articles/{{$article->id}}" method="post" class="del_form">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="delete">
              <input type="submit" name="" value="×" class="btn btn-danger pos-right-top delete-art">
            </form>
          @endif
        </div>

      @endforeach
    </section>
    <div id="modal-content" style="display:none;">
      <form enctype="multipart/form-data" method="post" action="/articles"  id="form-org">
      {{-- 以下を入れないとエラーになる --}}
      {{ csrf_field() }}
      <div class="art-form">
        <label for="image_input">
          Add Image
          <!-- <button type="button" class="btn btn-secondary" style="width:4rem;height:4rem;">？</button>   -->
          <input type="file" name="image_url" id="image_input" style="display:none;" class="art-form-img"/>
        </label>
        <div id="images">
        </div>
      </div>
      <div class="art-form">
        <input type="text" name="title" placeholder="title" class="art-form-title">
      </div>
      <div class="art-form">
        <textarea name="body" rows="8" cols="80" placeholder="content" class="art-form-body"></textarea>
      </div>
      <div class="art-form">
        <input type="submit" class="btn btn-success" value="send">
        <button type="button" class="btn btn-danger" id="modal-close">cancel</button>        
      </div>
    </form>
  </div>
  
    <script src="/js/scroll.js"></script>
    <script src="/js/modal.js"></script>
    <script src="/js/button.js"></script>
    <script src="/js/art_del.js"></script>
    <!-- <script src="/js/art_create.js"></script> -->

  @endsection
@endif