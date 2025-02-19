<x-layout>
    <div class="space-y-10 md:space-y-16">
        <body>
            <h1>Ajouter un article</h1>
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div>
            <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
                @csrf
        
                <div>
                    <label for="title">Titre:</label><br>
                    <input  class="rounded-full border py-3 border-slate-500 w-7/12 flex items-center pl-4" type="text" id="title" name="title" value="{{ old('title') }}" required>
                </div>
        
                <div>
                    <label for="description">Description:</label><br>
                    <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4" id="description" name="description" required rows="5">{{ old('description') }}</textarea>
                </div>
        
                <div>
                    <label for="context">Contexte:</label><br>
                    <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4" id="context" name="context" required rows="5" >{{ old('context') }}</textarea>
                </div>
        
                <div>
                    <label for="instruction">Instruction:</label><br>
                    <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4" id="instruction" rows="5" name="instruction" required>{{ old('instruction') }}</textarea>
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image :</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
        
                <div>
                    <label for="category_id">Catégorie:</label><br>
                    <select name="category_id" id="category_id" class="rounded-full border py-3 border-slate-500 w-7/12 flex items-center pl-4" required>
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="bg-black rounded-full text-slate-50 p-5 text-base "  type="submit">Enregistrer</button>
            </form>
        </div>
        </body>
    </div>
</x-layout> 

