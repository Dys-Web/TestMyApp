<x-layout>

@section('content')
<div class="container mx-auto p-5 bg-white shadow-md rounded-lg">

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

    <form method="POST" action="{{ route('article.update', $article) }}" class="space-y-5">

        @csrf

        @method('PUT')

        <div>
        <label for="title" class="block text-sm font-medium text-gray-700" >Titre : </label>
            <input class="rounded-full border py-3 border-slate-500 w-7/12 flex items-center pl-4" type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description : </label>
            <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4"  name="description" id="description" required rows="5">{{ old('description', $article->description) }}</textarea>
        </div>

        <div>
            <label for="context" class="block text-sm font-medium text-gray-700">Contexte : </label>
            <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4"  name="context" id="context" required rows="5">{{ old('context', $article->context) }}</textarea>
        </div>

        <div >
            <label for="instruction" class="block text-sm font-medium text-gray-700">Instruction : </label>
            <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4"  name="instruction" id="instruction" required rows="5">{{ old('instruction', $article->instruction) }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700" >Image : </label>
            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-Ig cursor-pointer bg-gray-50 focus:outline-none" value="{{ old('image', $article->image) }}" required>
        </div>
        <div>
            <button  class="bg-black rounded-full text-slate-50 p-5 text-base " type="submit">Mettre à jour</button>
        </div>
    </form>
</div>

</x-layout>