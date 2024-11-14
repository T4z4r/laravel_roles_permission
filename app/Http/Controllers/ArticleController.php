<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use  Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:add articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['index']),
            new Middleware('permission:delete articles', only: ['index']),
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['articles'] = Article::latest()->paginate(10);
        $data['count'] = 1;

        return view('articles.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'author' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // store data in the database
            $article = new Article();
            $article->title = $request->title;
            $article->author = $request->author;
            $article->text = $request->text;
            $article->save();
            return redirect()->route('articles.index')->with('success', 'Article created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('articles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data['article'] = Article::findOrFail($id);

        return view('articles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'author' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // store data in the database
            $article = Article::findOrFail($id);
            $article->title = $request->title;
            $article->author = $request->author;
            $article->text = $request->text;
            $article->save();

            return redirect()->route('articles.index')->with('success', 'Article updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article == null) {
            return back()->with('error', 'Article does not exist');
        }

        // Delete article from DB
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article was Deleted Successfully!');
    }
}
