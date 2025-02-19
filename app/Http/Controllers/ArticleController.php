<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index() : View
    {
       
        return view('articles.index', [
            'articles' => Article:: latest()->paginate(5),
        ] ) ;
    }

    public function show(Article $article) : View
    {

        return view('articles.show', [
            'article' => $article,
        ]);
    }
    
    public function create() : View
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'required|string',
            'instruction' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
    
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    
        $article = new Article;
        $article->slug = $slug;
        $article->title = $validatedData['title'];
        $article->description = $validatedData['description'];
        $article->context = $validatedData['context'];
        $article->instruction = $validatedData['instruction'];
        $article->category_id = $validatedData['category_id'];
       
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $article->image = $name;
        }
        $article->save();
    
        return redirect()->route('index');
    }

    public function edit(Article $article) : View
{
    return view('articles.edit', [
        'article' => $article,
    ]);
}

public function update(Request $request, Article $article)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'context' => 'required|string',
        'instruction' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $slug = Str::slug($request->title);
    $originalSlug = $slug;
    $counter = 1;

    while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    $article->slug = $slug;
    $article->title = $validatedData['title'];
    $article->description = $validatedData['description'];
    $article->context = $validatedData['context'];
    $article->instruction = $validatedData['instruction'];

    if($request->hasFile('image')) {
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        $article->image = $name;
    }

    $article->save();

    return redirect()->route('article.show', $article);
}

public function destroy(Article $article)
{
    $article->delete();

    return redirect()->route('index');

}

}

