<x-layout :title="$article->title">
    <div class="space-y-10 md:space-y-16">
        <div class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-lg" id="article_pdf">
            <div class="flex flex-col">
                {{-- Image et QR code en ligne --}}
                <div class="flex flex-col md:flex-row items-start">
                    {{-- Image de l'article --}}
                    <div class="md:w-2/3">
                        @if ($article->image)
                            <img class="w-full h-64 object-cover rounded-lg" src="{{ asset('images/'.$article->image) }}" alt="{{ $article->title }}">
                        @else
                            <img class="w-full h-64 object-cover rounded-lg" src="https://via.placeholder.com/640x480.png" alt="Placeholder">
                        @endif
                    </div>
                    {{-- QR code à côté de l'image --}}
                    <div class="md:w-1/3 mt-4 md:mt-0 md:pl-4">
                        <div class="border p-4 rounded-lg shadow-md">
                            {!! QrCode::size(100)->generate(route('article.show', ['article' => $article->slug])) !!}
                        </div>
                    </div>
                </div>

                {{-- Catégorie et titre --}}
                <div class="mt-4">
                    @if ($article->category)
                        <a href="#" class="underline font-bold text-slate-900 text-lg">{{ $article->category->name }}</a>
                    @endif
                    <h1 class="mt-2 font-bold text-slate-900 text-3xl">{{ $article->title }}</h1>
                </div>

                {{-- Contenu de l'article --}}
                <div class="mt-4 text-gray-700">{!! nl2br(e($article->context)) !!}</div>
                <div class="mt-4 text-gray-700">{!! nl2br(e($article->instruction)) !!}</div>

                {{-- Options --}}
                <div class="relative mt-6">
                    <button class="bg-gray-900 text-white px-6 py-4 rounded-full flex items-center transition-colors duration-200" onclick="toggleOptionsMenu(this)">
                        Options
                    </button>
                    <div class="absolute -left-56 bottom-10 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden options-menu">
                        <ul class="flex flex-col gap-2">
                            <li>
                                <a href="{{ route('article.edit', $article) }}" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM6 12v2a1 1 0 001 1h2a1 1 0 001-1v-2H6z" />
                                    </svg>
                                    Modifier
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('article.destroy', $article) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-400 flex items-center" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 2a1 1 0 00-1 1v1H3a1 1 0 000 2h14a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zM4 7v10a2 2 0 002 2h8a2 2 0 002-2V7H4z" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('article.pdf', $article) }}" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-400 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 2a1 1 0 00-1 1v1H3a1 1 0 000 2h14a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zM4 7v10a2 2 0 002 2h8a2 2 0 002-2V7H4z" />
                                    </svg>
                                    Télécharger PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsqr/1.4.0/jsQR.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        function toggleOptionsMenu(button) {
            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const optionsMenus = document.querySelectorAll('.options-menu');
            optionsMenus.forEach(menu => {
                if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</x-layout>