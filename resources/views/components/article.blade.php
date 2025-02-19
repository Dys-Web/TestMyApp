@props(['article', 'list' => false])

 {{-- Début du post --}}
 <article class="flex flex-col lg:flex-row pb-10 md:pb-16 border-b">
    <div class="lg:w-5/12">
        @if ($article->image)
            <img class="w-full max-h-64 object-cover " src="{{ asset('images/'.$article->image) }}" alt="{{ $article->title }}" >
            
        @else
        <img class="w-full max-h-64 object-cover " src="https://via.placeholder.com/640x480.png" alt="Placeholder">
            
        @endif
    </div>
    <div class="flex flex-col items-start mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
        @if ($article->category)
            <a href="" class="underline font-bold text-slate-900 text-lg"> {{ $article->category ->name}} </a>
        @endif
        {{-- <a href="" class="underline font-bold text-slate-900 text-lg">Catégorie</a> --}}
        <h1 class="font-bold text-slate-900 text-3xl lg:text-5xl leading-tight"> {{ $article->title }} </h1>
        <ul class="flex flex-wrap gap-2">
            <li><a href="" class="px-3 py-1 bg-indigo-700 text-indigo-50 rounded-full text-sm">Tag 1</a></li>
            <li><a href="" class="px-3 py-1 bg-indigo-700 text-indigo-50 rounded-full text-sm">Tag 2</a></li>
        </ul>
        <p class="text-xl lg:text-2xl text-slate-600">
            @if ($list)
                {{ $article->description }}
            @else
            {!! nl2br(e($article->context))  !!}
            @endif
            
        </p>
        @if ($list)
        <a href="{{ route('article.show', ['article'=>$article->slug]  ) }}" class="flex items-center py-5 px-7 font-semibold bg-slate-900 transition text-slate-50 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
            Lire le Contexte      
        </a>
        @else
        <p class="flex flex-row justify-between items-center space-x-5">

            <a href="{{ route('article.edit', ['article'=>$article]  ) }}" class="flex items-center py-5 px-7 font-semibold bg-slate-900 transition text-slate-50 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                Modifier    
            </a>
            
            <form action="{{ route('article.destroy', ['article'=>$article]  ) }}" method="post" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center py-5 px-7 font-semibold bg-red-600 transition text-slate-50 rounded-full" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Supprimer
                </button>
            </form>
        </p>
        @endif
    </div>
</article>
{{-- Fin du post --}}