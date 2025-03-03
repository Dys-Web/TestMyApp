<x-layout>

@section('content')
<div class="p-6 bg-slate-600 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-900 hover:-translate-y-1 transition-transform max-lg mx-auto">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h1 class="text-2xl font-bold mb-6" >Modifier l'article</h1>

    <form method="POST" action="{{ route('article.update', $article) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-8">

        @csrf

        @method('PUT')

        <div>
        <label for="title" class="block text-white" >Titre : </label>
            <input class="rounded-full border py-3 border-slate-500 w-full flex items-center pl-4 text-black" type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}" required>
            @error('title')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
             @enderror
        </div>

        <div>
            <label for="category_id" class="block text-white">Catégorie :</label>
            <select name="category_id" id="category_id" class="rounded-full border py-3 border-slate-500 w-full flex items-center pl-4 text-black bg-white" required>
                <option value="">-- Choisir une catégorie --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-white">Description : </label>
            <textarea class="rounded-md border py-3 border-slate-500 w-full flex items-center pl-4 text-black"  name="description" id="description" required rows="5">{{ old('description', $article->description) }}</textarea>
            @error('description')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="context" class="block text-white">Contexte : </label>
            <textarea class="rounded-md border py-3 border-slate-500 w-full flex items-center pl-4 text-black"  name="context" id="context" required rows="5">{{ old('context', $article->context) }}</textarea>
            @error('context')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
             @enderror
        </div>

        <div >
            <label for="instruction" class="block text-white">Instruction : </label>
            <textarea class="rounded-md border py-3 border-slate-500 w-full flex items-center pl-4 text-black "  name="instruction" id="instruction" required rows="5">{{ old('instruction', $article->instruction) }}</textarea>
            @error('instruction')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-white">Image actuelle</label>
            <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->title }}" class="w-32 h-32 object-cover rounded-lg mb-4">
            <label for="image" class="block text-white" >Image : </label>
            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-Ig cursor-pointer bg-gray-50 focus:outline-none" value="{{ old('image', $article->image) }}" required>
            @error('image')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button  class="bg-black rounded-full text-slate-50 p-5 text-base " type="submit">Mettre à jour</button>
        </div>
    </form>
</div>

</x-layout>

