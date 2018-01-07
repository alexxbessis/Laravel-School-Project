<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index')->with('articles', $articles);
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|nullable|max:1999',
        ]);
        // Traitement de l'image
        if($request->hasFile('image')){
            // Récupération du nom de l'image
            $fullName = $request->file('image')->getClientOriginalName();
            // Récupération du nom de l'image (sans l'extension)
            $name = pathinfo($fullName, PATHINFO_FILENAME);
            // Récupération de l'extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Création d'un nom unique pour l'image
            $nameToStore = $name . '_' . time() . '.' . $extension;
            // Déplacement de l'image dans le bon dossier
            $path = $request->file('image')->storeAs('public/images', $nameToStore);

        } else {
            $nameToStore = 'default.png';
        }

        // Création de l'article
        $article = new Article;
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->image_name = $nameToStore;
        $article->user_id = Auth()->user()->id;
        $article->save();

        return redirect('/')->with('success', 'Article créé!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show')->with('article', $article);
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
        return view('articles.edit')->with('article', $article);
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        // Édition de l'article
        $article = Article::find($id);
        // Vérification de l'auteur
        if($article->user_id !== auth()->user()->id){
            return redirect('/articles')->with('error', 'Page non autorisée');
        }
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();

        return redirect('/')->with('success', 'Article édité!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        // Vérification de l'auteur
        if($article->user_id !== auth()->user()->id){
            return redirect('/articles')->with('error', 'Page non autorisée');
        }
        $article->delete();

        return redirect('/')->with('success', 'Article supprimé!');
    }
}
