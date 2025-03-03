<x-layout>
    <div class="p-4 bg-slate-600 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-900 hover:-translate-y-1 transition-transform">
        <h1 class="text-white text-2xl mb-6">Ajouter un article</h1>

        @if ($errors->any())
            <div class="alert alert-danger mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf

                <div>
                    <label for="title" class="block text-white">Titre:</label><br>
                    <input class="rounded-full border py-3 border-slate-500 w-7/12 flex items-center pl-4" type="text" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-white">Catégorie:</label><br>
                    <select name="category_id" id="category_id" class="rounded-full border py-3 border-slate-500 w-full flex items-center pl-4 text-black bg-white" required>
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                     @enderror
                </div>

                <div>
                    <label for="description" class="block text-white">Description:</label><br>
                    <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4" id="description" name="description" required rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="context" class="block text-white">Contexte:</label><br>
                    <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4" id="context" name="context" required rows="5">{{ old('context') }}</textarea>
                    @error('context')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
                </div>

                <div>
                    <label for="instruction" class="block text-white">Instruction:</label><br>
                    <textarea class="rounded-md border py-3 border-slate-500 w-7/12 flex items-center pl-4" id="instruction" rows="5" name="instruction" required>{{ old('instruction') }}</textarea>
                    @error('instruction')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
                </div>
                
                <div>
                    <label for="image" class="block text-white">Image :</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    @error('image')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 flex justify-center">
                    <button class="bg-black rounded-full text-slate-50 p-5 text-base" type="submit">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>