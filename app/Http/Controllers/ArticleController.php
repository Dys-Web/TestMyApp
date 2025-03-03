<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;


class ArticleController extends Controller
{
    public function index(): ViewContract
    {
        return view('articles.index', [
            'articles' => Article::latest()->paginate(5),
        ]);
    }

    public function show(Article $article): ViewContract
    {
        // $url = "http://192.168.1.9:8000/" . $article->slug; // URL à passer à la vue
        $url = "http://192.168.100.9:8000/articles/" . $article->slug; // URL à passer à la vue
        $qrCode = QrCode::size(150)->generate($url);
        return view('articles.show', [
            'article' => $article,
            'qrCode' => $qrCode,
            // Passer l'URL au lieu du QR code
        ]);
    }

    public function create(): ViewContract
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
      try{
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $article->image = $name;
        }
        $article->save();

        return redirect()->route('index')->with('success', 'Article créé avec succès');
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'article : ' . $e->getMessage());
    }
    }
//Formulaire de modification
    public function edit(Article $article): ViewContract
    {
        $categories = Category::all();
        return view('articles.edit', [
            "article" => $article,
            "categories" => $categories,
        ]);
    }
//Modification de l'article
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'required|string',
            'instruction' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    try{
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $article->image = $name;
        }

        $article->save();

        return redirect()->route('article.show', $article)->with('success', 'Article modifié avec succès');
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification de l\'article : ' . $e->getMessage());
    }    
    }

    //Suppression de l'article
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return redirect()->route('index')->with('success', 'Article supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'article : ' . $e->getMessage());
        }
    }

    public function scannage(): ViewContract
    {
        return view('articles.scanner');
    }

    // public function qrscan(): ViewContract
    // {
    //     dd('cest bon ca marche');
    //     return view('articles.scanner');
    // }

    public function pdfView(Article $article): ViewContract
    {
        $qrCode = QrCode::size(100)->generate("http://192.168.100.9:8000/articles/". $article->slug);
        $article->qr_code = $qrCode;
        return view('articles.pdf', compact('article', 'qrCode'));
    }

    public function sign($text,$key)
    {
        return hash_hmac('sha256', $text, $key);
    }

    public function generate(Article $article): ViewContract
    {
        $url = "http://192.168.100.9:8000/articles/".  $article->slug; // URL à passer à la vue
        $qrCode = QrCode::size(150)->generate($url);

        // Passer le QR code à la vue
        return view('qrcode.show', compact('qrCode'));
    }
}
?>