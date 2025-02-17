<x-layout :title="$article->title ">
        <div class="space-y-10 md:space-y-16">

           <x-article :$article />
            
        {{-- <a href="{{ route('index') }}"class="btn btn-secondary mt-4">Retour à la liste</a> --}}
        </div>
</x-layout>

