<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    <style>
       body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
        }
        .qr-code {
            margin-top: 20px;
        }
        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .flex-item {
            flex: 1;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container" id="pdf-content">
        <h1 class="title">{{ $article->title }}</h1>
        <div class="flex-container">
            {{-- image de l'article  --}}
            <div class="flex-container">
                @if ($article->image)
                    <img class="w-full h-64 object-cover rounded-lg" src="{{ asset('images/'.$article->image) }}" alt="{{ $article->title }}">
                @else
                    <img class="w-full h-64 object-cover rounded-lg" src="https://via.placeholder.com/640x480.png" alt="Placeholder">
                @endif
            </div>     
            {{-- Qr code à côté de l'image --}}
            <div class="flex-item">
                <div class="border p-4 rounded-lg shadow-md">
                    {!! QrCode::size(100)->generate(route('article.show', ['article' => $article->slug])) !!}
                </div>
            </div>
        </div>
        <p>{{ $article->description }}</p>
        <p>{{ $article->instruction }}</p>
        <button class="download-btn" id="download-pdf">Télécharger PDF</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('download-pdf').addEventListener('click', function () {
            const element = document.getElementById('pdf-content');
            html2pdf().from(element).save('article.pdf');
        });
    </script>
</body>
</html>