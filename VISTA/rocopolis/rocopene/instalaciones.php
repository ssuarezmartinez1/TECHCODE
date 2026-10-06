<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalaciones | Rocopolis DC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brandPurple: '#9333ea',
                        brandAqua: '#06b6d4',
                        brandDark: '#0a0a0a'
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        heading: ['Orbitron', 'sans-serif']
                    }
                }
            }
        };
    </script>
</head>
<body class="font-sans bg-brandDark text-white">
    <nav class="sticky top-0 z-50 bg-brandDark/95 backdrop-blur-md border-b border-gray-800">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php" class="text-xl md:text-2xl font-black font-heading tracking-tighter">
                ROCOPOLIS <span class="text-brandAqua">DC</span>
            </a>
            <a href="index.php" class="text-sm font-bold uppercase tracking-widest text-brandAqua hover:text-white transition">
            </a>
        </div>
    </nav>

    <main>
        <section class="py-24 text-center border-b border-gray-800 bg-gradient-to-b from-[#111111] to-brandDark">
            <div class="container mx-auto px-6">
                <p class="text-brandAqua font-bold uppercase tracking-[0.3em] mb-4">Conoce el lugar</p>
                <h1 class="text-5xl md:text-7xl font-black font-heading italic">NUESTRAS <span class="text-brandAqua">INSTALACIONES</span></h1>
                <p class="max-w-2xl mx-auto mt-6 text-lg text-gray-400">Un espacio diseñado para que cada sesión se convierta en un nuevo desafío.</p>
            </div>
        </section>

        <section class="py-20 container mx-auto px-6">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <p class="text-brandPurple font-bold uppercase tracking-widest mb-2">Recorrido visual</p>
                    <h2 class="text-3xl md:text-4xl font-black font-heading">MIRA EL ESPACIO</h2>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:col-span-2 rounded-2xl overflow-hidden border border-brandAqua/40 bg-[#111111]">
                    <img src="public/imagenes/Captura de pantalla ig.png" class="w-full max-h-[560px] object-cover" alt="Vista principal de las instalaciones">
                </div>
                <div class="rounded-2xl overflow-hidden border border-gray-800 bg-[#111111]">
                    <img src="public/imagenes/2023-06-28.webp" class="w-full h-72 object-cover" alt="Zona de escalada">
                </div>
                <div class="rounded-2xl overflow-hidden border border-gray-800 bg-[#111111]">
                    <img src="public/imagenes/niños.webp" class="w-full h-72 object-cover" alt="Escalada para niños y familias">
                </div>
            </div>
        </section>

        <section class="py-20 bg-[#111111] border-y border-gray-800">
            <div class="container mx-auto px-6">
                <div class="text-center mb-10">
                    <p class="text-brandAqua font-bold uppercase tracking-widest mb-2">En movimiento</p>
                    <h2 class="text-3xl md:text-4xl font-black font-heading">VIDEOS DE ROCOPOLIS</h2>
                </div>
                <div class="max-w-5xl mx-auto rounded-2xl overflow-hidden border border-brandPurple/50 bg-black shadow-2xl">
                    <video class="w-full aspect-video object-cover" controls poster="public/imagenes/imagen fondo de inicio 2.png">
                        <source src="public/videos/instalaciones.mp4" type="video/mp4">
                        Tu navegador no puede reproducir este video.
                    </video>
                </div>
                <p class="text-center text-sm text-gray-500 mt-4">Agrega tu video en `public/videos/instalaciones.mp4`.</p>
            </div>
        </section>

        <section class="py-24 text-center">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-5xl font-black font-heading mb-6">¿LISTO PARA EL RETO?</h2>
                <p class="text-gray-400 mb-8">Vuelve al inicio o elige tu próxima experiencia de escalada.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="index.php" class="px-8 py-4 border-2 border-brandAqua text-brandAqua font-bold rounded-full hover:bg-brandAqua hover:text-brandDark transition">
                        <i class="fa-solid fa-house mr-2"></i>VOLVER AL INICIO
                    </a>
                    <a href="index.php#precios" class="px-8 py-4 bg-brandPurple text-white font-bold rounded-full hover:bg-brandPurple/80 transition">
                        <i class="fa-solid fa-person climbing mr-2"></i>¡ANÍMATE A ESCALAR!
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
