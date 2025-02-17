<x-layout>
        <div class="space-y-10 md:space-y-16">
            @foreach ($articles as $article)
           <x-article :$article list />
            @endforeach
        
            {{ $articles->links() }}
        </div>
</x-layout> 


