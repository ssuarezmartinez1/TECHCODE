<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        require_once 'VISTA/iniciar sesion.php';
        exit;
    case 'planes':
        require_once 'CONTROLADOR/PlanController.php';
        $controller = new PlanController();
        $controller->mostrarPlanes();
        exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocopolis DC - Centro de Escalada</title>
    <link rel="stylesheet" href="estilos.css">
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
<body class="font-sans bg-brandDark text-white">

    <nav class="fixed top-0 left-0 w-full z-50 bg-brandDark/90 backdrop-blur-md border-b border-gray-800">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="public/imagenes/image-removebg-preview.png" class="w-12 h-12 object-contain rounded-full border-2 border-brandAqua/30 bg-[#0a0a0a] p-0.5" alt="Logo Rocopolis DC" />
                <span class="text-2xl font-black font-heading tracking-tighter">ROCOPOLIS <span class="text-brandAqua">DC</span></span>
            </div>
            <div class="hidden md:flex space-x-8 font-bold text-sm uppercase tracking-widest items-center">
                <a href="index.php" class="hover:text-brandAqua transition">Inicio</a>
                <a href="#muros" class="hover:text-brandAqua transition">Nuestros Muros</a>
                <a href="#servicios" class="hover:text-brandAqua transition">Servicios</a>
                <a href="index.php#precios" class="hover:text-brandAqua transition">Planes</a>
                <?php if (!empty($_SESSION['usuario'])): ?>
                    <a href="catalogo.php" class="hover:text-brandAqua transition">Catálogo</a>
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-2 px-4 py-2 border-2 border-brandAqua rounded-full text-brandAqua hover:bg-brandAqua hover:text-brandDark transition">
                            <span><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-2 hidden group-hover:block bg-[#111111] border border-gray-700 rounded-xl shadow-xl min-w-[180px] py-2">
                            <a href="catalogo.php" class="block px-4 py-2 text-sm text-white hover:bg-brandPurple transition">Ver catálogo</a>
                            <a href="index.php?logout=1" class="block px-4 py-2 text-sm text-white hover:bg-brandPurple transition">Cerrar sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="index.php?action=login" class="px-4 py-2 border-2 border-brandPurple rounded-full hover:bg-brandPurple transition">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <section id="inicio" class="h-screen flex items-center justify-center relative overflow-hidden pt-20">
        <img src="public/imagenes/imagen fondo de inicio 2.png" class="absolute inset-0 w-full h-full object-cover opacity-30 z-0 pointer-events-none" alt="Fondo Desafía tus límites">
        
        <div class="container mx-auto px-6 text-center z-10">
            <h1 class="text-6xl md:text-8xl font-black font-heading mb-4 leading-tight">
                DESAFÍA TUS <br> <span class="text-gradient">LÍMITES</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 max-w-2xl mx-auto mb-8 font-light">
                "Muro de escalada bajo techo tenemos 10 metros de altura y una zona muy divertida de cueva. Somos el único muro de Colombia con boulder y escalda deportiva."

            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="index.php?action=login" class="px-10 py-4 bg-brandPurple text-white font-bold rounded-full text-lg glow-purple hover:scale-105 transition transform">EMPEZAR A ESCALAR</a>
                <a href="instalaciones.php" class="px-10 py-4 border-2 border-brandAqua text-brandAqua font-bold rounded-full text-lg hover:bg-brandAqua hover:text-brandDark transition">VER INSTALACIONES</a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-brandDark to-transparent z-10"></div>
    </section>

    <section class="py-12 bg-brandDark border-y border-gray-800">
        <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl font-black font-heading text-brandAqua">10m</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest">Altura Máxima</p>
            </div>
            <div>
                <p class="text-4xl font-black font-heading text-brandPurple">23+</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest">Rutas Montadas</p>
            </div>
            <div>
                <p class="text-4xl font-black font-heading text-brandAqua">250m²</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest">Zona de Bloque</p>
            </div>
            <div>
                <p class="text-4xl font-black font-heading text-brandPurple">100%</p>
                <p class="text-gray-400 uppercase text-xs tracking-widest">Seguridad Certificada</p>
            </div>
        </div>
    </section>

    <section id="muros" class="py-24 container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <h2 class="text-4xl font-black font-heading mb-6 italic">INSTALACIONES DE <span class="text-brandAqua">ÉLITE</span></h2>
                <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                    Rocópolis DC es un centro y comunidad de escalada bajo techo ubicado en la zona norte de Bogotá,
                     Colombia. Destaca principalmente por contar con un muro de 10 metros de altura, lo que lo convierte en uno de los pocos
                      lugares en la ciudad equipados para practicar escalada deportiva en modalidad de "yo-yo" (con cuerda y arnés), además
                       de contar con zonas para boulder (escalada a baja altura sin cuerda) y velocidad. 
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <i class="fa-solid fa-check text-brandPurple"></i>
                        <span>Muros de dificultad con asegurador y cuerdas.</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fa-solid fa-check text-brandPurple"></i>
                        <span>Zona de boulder con colchonetas de alta densidad.</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fa-solid fa-check text-brandPurple"></i>
                        <span>Área de entrenamiento funcional.</span>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2">
                <div class="rounded-3xl overflow-hidden border-2 border-brandAqua/50 bg-[#080808] shadow-2xl glow-aqua">
                    <img src="public/imagenes/Captura de pantalla ig.png" class="w-full h-auto object-cover max-h-[500px]" alt="Instalaciones de élite Rocopolis DC">
                </div>
            </div>
        </div>
    </section>

    <section id="servicios" class="py-24 bg-[#0f0f0f]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black font-heading uppercase tracking-tighter">Más que solo <span class="text-brandPurple">Escalada</span></h2>
                <div class="h-1 w-24 bg-brandAqua mx-auto mt-4"></div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card p-8 rounded-3xl text-center service-square">
                    <div class="w-16 h-16 bg-brandPurple/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-graduation-cap text-3xl text-brandPurple"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Escuela de Escalada</h3>
                    <p class="text-gray-400">Cursos básicos y avanzados para niños y adultos. Aprende técnica, seguridad y nudos con expertos.</p>
                </div>
                <div class="glass-card p-8 rounded-3xl text-center service-square">
                    <div class="w-16 h-16 bg-brandAqua/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-spa text-3xl text-brandAqua"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Yoga</h3>
                    <p class="text-gray-400">Complementa tu entrenamiento con clases de Yoga dirigidas a la flexibilidad y equilibrio.</p>
                </div>
                <div class="glass-card p-8 rounded-3xl text-center service-square">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Eventos & Cumpleaños</h3>
                    <p class="text-gray-400">Celebra un día inolvidable con retos de altura. Ideal para grupos corporativos y fiestas infantiles.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="precios" class="py-24 container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-black font-heading italic">ELIGE TU <span class="text-brandAqua">DESAFÍO</span></h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php
            $opciones = [
                [
                    'nombre' => 'Día de cueva ',
                    'precio' => '25.000',
                    'caracteristicas' => ['Para todo tipo de niveles', 'No incluye el equipo(Se puede alquilar en la recepcion)']
                ],
                [
                    'nombre' => 'Día recreativo',
                    'precio' => '65.000',
                    'caracteristicas' => ['para principiantes', 'incluye equipo completo', 'incluye instructor']
                ],
                [
                    'nombre' => 'Día libre',
                    'precio' => '40.000',
                    'caracteristicas' => ['para gente que ya tenga experiencia', 'no incluye equipo', 'no incluye instructor', 'se tiene que hacer test de aseguracion']
                ]
            ];
            foreach ($opciones as $index => $opcion):
                $esDestacado = ($index === 1);
            ?>
                <div class="rounded-3xl overflow-hidden <?= $esDestacado ? 'bg-gradient-to-br from-brandPurple to-brandAqua glow-purple scale-105 p-1' : 'bg-gray-800 p-1'; ?>">
                    <div class="bg-brandDark p-8 rounded-[calc(1.5rem-4px)] h-full flex flex-col relative overflow-hidden">
                        <?php if ($esDestacado): ?>
                            <div class="absolute top-4 right-[-35px] bg-brandAqua text-brandDark font-bold py-1 px-10 rotate-45 text-xs uppercase z-10">Popular</div>
                        <?php endif; ?>

                        <h3 class="text-2xl font-bold uppercase mb-2 text-brandAqua font-heading"><?= $opcion['nombre']; ?></h3>
                        <p class="text-4xl font-black mb-6">$<?= htmlspecialchars($opcion['precio']); ?><span class="text-sm text-gray-500 font-normal"> /sesión</span></p>
                        
                        <ul class="space-y-4 mb-8 flex-grow text-gray-300">
                            <?php foreach ($opcion['caracteristicas'] as $caracteristica): ?>
                                    <li>
                                        <i class="fa-solid fa-circle-check <?= $esDestacado ? 'text-brandPurple' : 'text-brandAqua'; ?> mr-2"></i> 
                                        <?= htmlspecialchars($caracteristica); ?>
                                    </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <a href="index.php?action=login" class="w-full inline-flex items-center justify-center py-4 <?= $esDestacado ? 'bg-brandPurple text-white hover:bg-brandPurple/80' : 'border-2 border-brandAqua text-white hover:bg-brandAqua hover:text-brandDark'; ?> transition font-bold rounded-xl">
                            RESERVAR
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    </section>

    <footer id="contacto" class="bg-[#050505] pt-20 pb-10 border-t border-gray-900">
        <div class="container mx-auto px-6 grid md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-2">
                <h2 class="text-3xl font-black font-heading mb-6 tracking-tighter">ROCOPOLIS <span class="text-brandAqua">DC</span></h2>
                <p class="text-gray-500 max-w-md mb-8 italic">"Superando la gravedad desde el norte de Bogotá. Únete a la mayor comunidad de escalada deportiva del país."</p>
                <div class="flex space-x-6">
                    <a href="https://www.instagram.com/rocopolisdc/" target="_blank" rel="noopener noreferrer" class="text-2xl hover:text-brandPurple transition" aria-label="Instagram de Rocopolis DC"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/rocopolisdc" target="_blank" rel="noopener noreferrer" class="text-2xl hover:text-brandAqua transition" aria-label="Facebook de Rocopolis DC"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://wa.me/+57 310 4071483" target="_blank" rel="noopener noreferrer" class="text-2xl hover:text-brandPurple transition" aria-label="WhatsApp de Rocopolis DC"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-bold uppercase text-brandAqua mb-6">Ubicación</h4>
                <p class="text-gray-400"> Cra. 49, #128c17<br>Bogotá, Colombia</p>
                <p class="mt-4 text-brandPurple font-bold">Norte de la ciudad</p>
            </div>
            <div>
                <h4 class="font-bold uppercase text-brandAqua mb-6">Horarios</h4>
                <p class="text-gray-400">Lun - Vie: 2:00 PM - 09:00 PM</p>
                <p class="text-gray-400">Sábados: 09:00 AM - 06:00 PM</p>
                <p class="text-gray-400">Dom/Fest: 09:00 AM - 06:00 PM</p>
            </div>
        </div>
        <div class="text-center text-gray-700 text-xs border-t border-gray-900 pt-8">
            &copy; 2026 Rocopolis DC. Desarrollado con pasión por la montaña.
        </div>
    </footer>

</body>
</html>