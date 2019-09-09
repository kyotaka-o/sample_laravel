
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
  <h1><small>Cycling's photos</small> 
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

  @endsection
@else

  {{-- @yield('title')にテンプレートごとの値を代入 --}}
  @section('title', '記事一覧')
  @section('org_css')
  <link href="/css/articles.css" rel="stylesheet" type="text/css">
  <link href="/css/button.css" rel="stylesheet" type="text/css">
  @endsection
  {{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
  @section('content')
    <h1>Enjoy Cycling?</h1> 
    <div class="art-title">
      <h2>Cycling's photos</h2>
      <span id="directionality">▼</span>
    </div>

    <div class="menu">
      <div class="btn trigger">
        <span class="line"></span>
      </div>
      <div class="icons">
        <div class="rotater">
          <!-- <div class="btn btn-icon"> -->
            <a href="/articles/create">
              <button type="button" class="btn btn-icon btn-primary rounded-circle p-0" style="width:4rem;height:4rem;">New</button>  
            </a>
          <!-- </div> -->
        </div>
        <div class="rotater">
          <!-- <div class="btn btn-icon"> -->
            <a href="/">
              <button type="button" class="btn btn-icon btn-info rounded-circle p-0" style="width:4rem;height:4rem;">Mypage</button>  
            </a>
          <!-- </div> -->
        </div>
        <div class="rotater">
          <!-- <div class="btn btn-icon"> -->
            <a href="/">
              <button type="button" class="btn btn-icon btn-success rounded-circle p-0" style="width:4rem;height:4rem;">Users</button>  
            </a>
          <!-- </div> -->
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






    <section>
      @foreach ($articles as $article)

        <div class="art-card" style="background-image: url('/{{ str_replace('public/', 'storage/', $article->image_url)}}')"></div>

          <!-- <h4>{{$article->title}}</h4>
          <p>{{$article->body}}</p>
          <a href="/articles/{{$article->id}}">詳細を表示</a>
          <a href="/articles/{{$article->id}}/edit">編集する</a>
          <form action="/articles/{{$article->id}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete">
            <input type="submit" name="" value="削除する">
          </form>
          {{-- <a href="/articles/{{$article->id}}">削除する</a> --}} -->
      @endforeach
    </section>
    <script src="/js/scroll.js"></script>
    <script src="/js/button.js"></script>

  @endsection
@endif