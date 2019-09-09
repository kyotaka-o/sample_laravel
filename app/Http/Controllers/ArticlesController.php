<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Controllers\Auth;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     if(!\Auth::check()){
    //         return redirect('/');
    //     }
    // }
    public function index()
    {

      // $articles変数にArticleモデルから全てのレコードを取得して、代入
      $articles = Article::all();
    //   return $articles;
      return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // モデルからインスタンスを生成
      $article = new Article;
      // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
      $article->title = $request->title;
      $article->body = $request->body;
      $article->image_url = $request->image_url->storeAs('public/article_images', now().'_'.\Auth::user()->id . '.jpg');
      $article->save();
      // 保存後 一覧ページへリダイレクト
      return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // 引数で受け取った$idを元にfindでレコードを取得
      $article = Article::find($id);
      // viewにデータを渡す
      return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $article = Article::find($id);
      return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // idを元にレコードを検索して$articleに代入
      $article = Article::find($id);
      // editで編集されたデータを$articleにそれぞれ代入する
      $article->title = $request->title;
      $article->body = $request->body;
      // 保存
      $article->save();
      // 詳細ページへリダイレクト
      return redirect("/articles/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // idを元にレコードを検索
      $article = Article::find($id);
      // 削除
      $article->delete();
      // 一覧にリダイレクト
      return redirect('/articles');
    }
}
