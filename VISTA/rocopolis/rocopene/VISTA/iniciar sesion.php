<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Rocopolis DC</title>
    <link rel="stylesheet" href="public/css/estilo.css">
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
                        brandDark: '#0a0a0a',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        heading: ['Orbitron', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-brandDark text-white font-sans min-h-screen flex items-center justify-center px-4 py-10 relative overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-brandPurple/20 blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-brandAqua/20 blur-3xl"></div>

    <div class="relative w-full max-w-5xl grid lg:grid-cols-2 rounded-3xl overflow-hidden border border-gray-800 bg-[#0f0f0f]/95 shadow-2xl">
        <div class="hidden lg:flex flex-col justify-between p-12 bg-gradient-to-br from-brandPurple/90 to-brandAqua/80">
            <div>
                <img src="public/imagenes/image-removebg-preview.png" alt="Logo Rocopolis" class="w-20 h-20 object-contain rounded-2xl bg-[#0a0a0a]/70 p-3 mb-10">
                <p class="uppercase tracking-[0.3em] text-sm font-bold text-white/80 mb-4">Rocopolis DC</p>
                <h2 class="text-5xl font-black font-heading leading-tight">SUPERA<br>TUS LÍMITES</h2>
                <p class="mt-6 text-white/80 text-lg leading-relaxed">Crea tu cuenta y prepárate para vivir tu próxima aventura de escalada.</p>
            </div>
            <p class="text-sm font-bold uppercase tracking-widest text-white/70">Bogotá · Comunidad · Desafío</p>
        </div>

        <div class="p-7 sm:p-10 lg:p-12">
            <div class="mb-8">
                <p class="text-brandAqua font-bold uppercase tracking-[0.2em] text-xs mb-3">Únete a la comunidad</p>
                <h1 class="text-3xl sm:text-4xl font-black font-heading mb-3">INICIAR SESIÓN</h1>
                <p class="text-gray-400">Regístrate para reservar tu sesión de escalada.</p>
            </div>

        <?php if (!empty($error)): ?>
            <div class="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/50 text-red-400 text-sm text-center">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> Correo electrónico o contraseña incorrectos.
            </div>
        <?php endif; ?>

            <form action="catalogo.php" method="POST" class="space-y-5">
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="nombre" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Nombre</label>
                        <input id="nombre" type="text" name="nombre" placeholder="Tu nombre" autocomplete="given-name" required class="w-full rounded-xl border border-gray-700 bg-[#121212] px-4 py-3 text-white outline-none transition focus:border-brandAqua focus:ring-2 focus:ring-brandAqua/20">
                    </div>
                    <div>
                        <label for="apellidos" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Apellidos</label>
                        <input id="apellidos" type="text" name="apellidos" placeholder="Tus apellidos" autocomplete="family-name" required class="w-full rounded-xl border border-gray-700 bg-[#121212] px-4 py-3 text-white outline-none transition focus:border-brandAqua focus:ring-2 focus:ring-brandAqua/20">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Correo electrónico</label>
                    <input id="email" type="email" name="email" placeholder="tucorreo@ejemplo.com" autocomplete="email" required class="w-full rounded-xl border border-gray-700 bg-[#121212] px-4 py-3 text-white outline-none transition focus:border-brandAqua focus:ring-2 focus:ring-brandAqua/20">
                </div>
                <div>
                    <label for="telefono" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Teléfono</label>
                    <input id="telefono" type="tel" name="telefono" placeholder="300 000 0000" autocomplete="tel" class="w-full rounded-xl border border-gray-700 bg-[#121212] px-4 py-3 text-white outline-none transition focus:border-brandAqua focus:ring-2 focus:ring-brandAqua/20">
                </div>
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Contraseña</label>
                        <input id="password" type="password" name="password" placeholder="Mínimo 8 caracteres" autocomplete="new-password" minlength="8" required class="w-full rounded-xl border border-gray-700 bg-[#121212] px-4 py-3 text-white outline-none transition focus:border-brandPurple focus:ring-2 focus:ring-brandPurple/20">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs uppercase tracking-wider text-gray-400 mb-2">Confirmar contraseña</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Repite tu contraseña" autocomplete="new-password" minlength="8" required class="w-full rounded-xl border border-gray-700 bg-[#121212] px-4 py-3 text-white outline-none transition focus:border-brandPurple focus:ring-2 focus:ring-brandPurple/20">
                    </div>
                </div>
                <label class="flex items-start gap-3 text-sm text-gray-400">
                    <input type="checkbox" name="terminos" required class="mt-1 accent-brandAqua">
                    <span>Acepto los términos y condiciones de Rocopolis DC.</span>
                </label>
                <button type="submit" class="w-full py-4 bg-brandPurple text-white font-bold rounded-xl hover:bg-brandPurple/80 transition shadow-lg shadow-brandPurple/20">
                    CREAR CUENTA Y CONTINUAR <i class="fa-solid fa-arrow-right ml-2"></i>
                </button>
            </form>

            <div class="mt-7 text-center text-sm text-gray-500">
                <a href="index.php" class="hover:text-brandAqua transition"><i class="fa-solid fa-arrow-left mr-2"></i>Volver al inicio</a>
            </div>
        </div>
    </div>

</body>
</html>