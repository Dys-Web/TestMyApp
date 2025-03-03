    @props(['article', 'list' => false, 'qrCode' => null])

    {{-- Début du post --}}
    <div class="p-6 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:-translate-y-1 transition-transform max-lg mx-auto" id="article-content">
        <article class="flex flex-col lg:flex-row pb-8 md:pb-1 border-b border-gray-300">
            <div class="lg:w-5/12 relative">
                @if ($article->image)
                    <img class="w-full max-h-64 object-cover rounded-lg" src="{{ asset('images/'.$article->image) }}" alt="{{ $article->title }}">
                @else
                    <img class="w-full max-h-64 object-cover rounded-lg" src="https://via.placeholder.com/640x480.png" alt="Placeholder">
                @endif
            </div>
            <div class="flex flex-col items-start mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
                @if ($article->category)
                    <a href="#" class="underline font-bold text-gray-800 text-lg">{{ $article->category->name }}</a>
                @endif
                <h1 class="font-bold text-gray-800 text-3xl lg:text-xl leading-tight">{{ $article->title }}</h1>
                <p class="text-xl lg:text-2xl text-gray-600">
                    @if ($list)
                        {{ Str::limit($article->description, 100) }}
                    @else
                        {!! nl2br(e($article->context)) !!}
                    @endif
                </p>
                <div class="relative">
                    <button class="bg-gray-900 text-white px-6 py-4 rounded-full flex items-center transition-colors duration-200" onclick="toggleOptionsMenu(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 5h14M3 10h14M3 15h14" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        Options
                    </button>
                    <div class="absolute -right-56 bottom-10 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden options-menu">
                        <ul class="flex flex-col gap-2">
                            <li>
                                <a href="{{ route('article.show', ['article' => $article->slug]) }}" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4h4v4H4V4zm8 0h4v4h-4V4zM4 12h4v4H4v-4zm8 0h4v4h-4v-4z" />
                                    </svg>
                                    Lire le Contexte
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('article.edit', ['article' => $article]) }}" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-400 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM6 12v2a1 1 0 001 1h2a1 1 0 001-1v-2H6z" />
                                    </svg>
                                    Modifier
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('article.destroy', ['article' => $article]) }}" method="post" class="inline-block">
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
                            {{-- <li>
                                <a href="{{ route('article.pdf', ['article' => $article->slug]) }}" class="w-full text-left px-4 py-2 text-gray-800hover:bg-gray-400 flex items-center" id="download-pdf">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 2a1 1 0 00-1 1v1H3a1 1 0 000 2h14a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zM4 7v10a2 2 0 002 2h8a2 2 0 002-2V7H4z" />
                                    </svg>
                                    Télécharger PDF
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('article.show', ['article' => $article->slug]) }}" class="w-full text-left px-4 py-2 text-gray-800hover:bg-gray-400 flex items-center" id="scan-qr-code">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 3a1 1 0 011-1h2a1 1 0 110 2H5v2a1 1 0 11-2 0V4a1 1 0 010-1zm12-1a1 1 0 011 1v2a1 1 0 11-2 0V4h-2a1 1 0 110-2h2a1 1 0 011-1zM3 15a1 1 0 011 1v2a1 1 0 11-2 0v-2a1 1 0 011-1zm12 0a1 1 0 011 1v2a1 1 0 11-2 0v-2h-2a1 1 0 110-2h2a1 1 0 011 1z" />
                                    </svg>
                                    Scanner QR Code
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </article>
    </div>
    {{-- Fin du post --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsqr/1.4.0/jsQR.min.js"></script>
    <script>
        function toggleOptionsMenu(button) {
            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');
        }

        // Close the options menu if clicked outside
        document.addEventListener('click', function(event) {
            const optionsMenus = document.querySelectorAll('.options-menu');
            optionsMenus.forEach(menu => {
                if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });

        
        // document.getElementById('download-pdf').addEventListener('click', function(event) {
        //     event.preventDefault();
        //     const element = document.getElementById('article-content');
        //     html2pdf().from(element).set({
        //         margin: 1,
        //         filename: 'article.pdf',
        //         image: { type: 'jpeg', quality: 0.98 },
        //         html2canvas: { scale: 2 },
        //         jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        //     }).save();
        // });

        // document.getElementById('scan-qr-code').addEventListener('click', function() {
        //     startScanner();
        // });

        // let videoStream;

        // function startScanner() {
        //     const scannerContainer = document.getElementById('qr-scanner-container');
        //     const video = document.getElementById('qr-video');
        //     const qrResult = document.getElementById('qr-result');

        //     scannerContainer.classList.remove('hidden');
        //     qrResult.textContent = "Scan en cours...";

        //     navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        //         .then(stream => {
        //             videoStream = stream;
        //             video.srcObject = stream;
        //             video.setAttribute("playsinline", true);
        //             video.play();
        //             scanQR();
        //         })
        //         .catch(error => {
        //             qrResult.textContent = "⚠️ Impossible d'accéder à la caméra.";
        //             console.error(error);
        //         });
        // }

        // function scanQR() {
        //     const video = document.getElementById('qr-video');
        //     const canvas = document.createElement("canvas");
        //     const ctx = canvas.getContext("2d");

        //     function scan() {
        //         if (video.readyState === video.HAVE_ENOUGH_DATA) {
        //             canvas.width = video.videoWidth;
        //             canvas.height = video.videoHeight;
        //             ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        //             const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        //             const qrCode = jsQR(imageData.data, imageData.width, imageData.height);

        //             if (qrCode) {
        //                 const siteUrl = "{{ url('/') }}"; // URL de ton site Laravel
        //                 if (qrCode.data.startsWith(siteUrl)) {
        //                     document.getElementById('qr-result').textContent = "✅Code QR valide : Article reconnu";
        //                 } else {
        //                     document.getElementById('qr-result').textContent = "❌QR non valide";
        //                 }

        //                 setTimeout(stopScanner, 3000);
        //             } else {
        //                 requestAnimationFrame(scan);
        //             }
        //         } else {
        //             requestAnimationFrame(scan);
        //         }
        //     }

        //     scan();
        // }

        // function stopScanner() {
        //     const scannerContainer = document.getElementById('qr-scanner-container');
        //     scannerContainer.classList.add('hidden');

        //     if (videoStream) {
        //         videoStream.getTracks().forEach(track => track.stop());
        //     }
        // }
    </script>

