<!-- filepath: /C:/laragon/www/myapp/resources/views/articles/scanner.blade.php -->
<x-layout>
    <h1 style="text-center text-xl md:text-2xl lg:text-3xl">Scanner votre QR Code</h1>
    <div id="qr-reader" class="w-full max-w-xs h-96 m-auto"></div>
    <div id="qr-reader-results" style="text-center mt-4 text-lg"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
        // Fonction pour vérifier la signature
        function verifySignature(slug, signature, secretKey) {
            const expectedSignature = CryptoJS.HmacSHA256(slug, secretKey).toString();
            return expectedSignature === signature;
        }

        // Fonction pour vérifier si une chaîne est un JSON valide
        function isValidJson(text) {
            try {
                JSON.parse(text);
                return true;
            } catch (e) {
                return false;
            }
        }

        // Fonction de callback lors de la détection du QR code
        function onScanSuccess(decodedText, decodedResult) {
            const secretKey = "shazam";
            if (isValidJson(decodedText)) {
                try {
                    const qrData = JSON.parse(decodedText);
                    const { slug, signature } = qrData;

                    if (verifySignature(slug, signature, secretKey)) {
                        // Affiche le résultat dans la page
                        document.getElementById('qr-reader-results').innerText = `QR Code détecté : ${slug}`;
                        // Arrête le scanner si nécessaire
                        // html5QrcodeScanner.clear();
                    } else {
                        document.getElementById('qr-reader-results').innerText = "QR Code non reconnu.";
                    }
                } catch (e) {
                    document.getElementById('qr-reader-results').innerText = "Erreur lors de la lecture du QR Code";
                    console.error("Erreur lors de la lecture du QR Code : ", e);
                }
            } else {
                document.getElementById('qr-reader-results').innerText = "QR Code non valide.";
                console.warn("QR Code non valide.");
            }
        }

         // Initialisation et démarrage du scanner
         const html5QrcodeScanner = new Html5Qrcode("qr-reader");
        Html5Qrcode.getCameras().then(devices => {
            console.log("Caméras détectées :", devices);
            if (devices && devices.length) {
                const cameraId = devices[0].id; // Sélectionne la première caméra
                console.log("ID de la caméra selectionnée :", cameraId);
                html5QrcodeScanner.start(
                    cameraId,
                    { fps: 10, qrbox: 500 },
                    onScanSuccess,
                    (errorMessage) => {
                        console.error(`Erreur de scan : ${errorMessage}`);
                    }
                ).then(() => {
                    console.log("Scanner démarré avec succès.");
                }).catch(err => {
                    console.error(`Erreur lors du démarrage du scanner : ${err}`);
                });
            } else {
                console.error("Aucune caméra détectée.");
            }
        }).catch(err => {
            console.error("Impossible d'accéder aux caméras :", err);
        });
    
    </script>
</x-layout>