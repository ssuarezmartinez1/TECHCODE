<?php
session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: catalogo.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes y Servicios | Rocopolis DC</title>
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
<body class="font-sans bg-[#f3f3f3] text-[#181818]">

    <nav class="fixed top-0 left-0 w-full z-50 bg-[#07070a]/90 backdrop-blur-md border-b border-[#1d1d1d]">
        <div class="max-w-[1360px] mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="public/imagenes/image-removebg-preview.png" alt="Logo Rocopolis" class="w-12 h-12 md:w-14 md:h-14 object-contain rounded-full bg-[#0a0a0a] border border-[#06b6d4]/30 shadow-lg shadow-[#9333ea]/30">
                <span class="text-2xl md:text-3xl font-black font-heading tracking-tighter text-white">ROCOPOLIS <span class="text-[#06b6d4]">DC</span></span>
            </div>
            <div class="hidden md:flex space-x-8 font-bold text-sm uppercase tracking-widest items-center text-white">
                <a href="index.php" class="hover:text-[#06b6d4] transition">Inicio</a>
                <a href="#planes" class="hover:text-[#06b6d4] transition">Planes</a>
                <a href="#servicios" class="hover:text-[#06b6d4] transition">Servicios</a>

                <?php if (!empty($_SESSION['usuario'])): ?>
                    <div class="relative group">
                        <button type="button" class="flex items-center gap-2 px-4 py-2 border-2 border-[#06b6d4] rounded-full text-[#06b6d4] hover:bg-[#06b6d4] hover:text-[#07070a] transition">
                            <span><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-2 hidden group-hover:block bg-[#111111] border border-gray-700 rounded-xl shadow-xl min-w-[180px] py-2">
                            <a href="catalogo.php" class="block px-4 py-2 text-sm text-white hover:bg-[#9333ea] transition">Ver catálogo</a>
                            <a href="index.php?logout=1" class="block px-4 py-2 text-sm text-white hover:bg-[#9333ea] transition">Cerrar sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="index.php?action=login" class="px-5 py-2.5 border-2 border-[#9333ea] rounded-full bg-[#9333ea]/10 hover:bg-[#9333ea] transition">Reserva Ahora</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="pt-28 pb-16">
        <div class="max-w-[1200px] mx-auto px-4 md:px-6">
            <section class="catalog-category mb-8">
                <div class="category-header flex items-center justify-between mb-3">
                    <h2 class="text-[18px] md:text-[22px] font-bold text-[#1b1b1b] m-0">Escaladores</h2>
                </div>

                <div class="space-y-3">
                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/dia dificultar.png" alt="Día dificultad" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Día dificultad</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">Si eres un escalador experto y sabes escalar en punta / ...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 40,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Escaladores" data-name="Día dificultad" data-description="Si eres un escalador experto y sabes escalar en punta / ..." data-price="COP 40,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/dia dificultar con asegurador .png" alt="Día dificultad + asegurador" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Día dificultad + asegurador</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">Si quieres venir a escalar y tienes tu equipo y nece...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 60,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Escaladores" data-name="Día dificultad + asegurador" data-description="Si quieres venir a escalar y tienes tu equipo y nece..." data-price="COP 60,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/dia de cueva .png" alt="Cueva o boulder" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Cueva o boulder</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">2 horas en la zona de cueva o boulder de nuestro muro...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 25,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Escaladores" data-name="Cueva o boulder" data-description="2 horas en la zona de cueva o boulder de nuestro morro..." data-price="COP 25,000">+</button>
                    </article>
                </div>
            </section>

            <section class="catalog-category mb-8">
                <div class="category-header flex items-center justify-between mb-3">
                    <h2 class="text-[18px] md:text-[22px] font-bold text-[#1b1b1b] m-0">Salidas a la Naturaleza</h2>
                </div>

                <div class="space-y-3">
                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/salidas a la roco con team rocopolis.png" alt="Salida a la roca con el team ROCÓPOLIS DC" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Salida a la roca con el team ROCÓPOLIS DC</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">Nuestro servicio de salida a la roca ofrece una experien...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 160,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Salidas a la Naturaleza" data-name="Salida a la roca con el team ROCÓPOLIS DC" data-description="Nuestro servicio de salida a la roca ofrece una experien..." data-price="COP 160,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/dia a la roca mas equipo.png" alt="Día en la roca + equipo" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Día en la roca + equipo</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">Servicio de Salida a la Roca ¡Estás listo para una avent...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 200,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Salidas a la Naturaleza" data-name="Día en la roca + equipo" data-description="Servicio de Salida a la Roca ¡Estás listo para una avent..." data-price="COP 200,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/salida personalizada a la roca .png" alt="Salida personalizada a la roca" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Salida personalizada a la roca</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">Servicio de Salida Personalizada a la Roca Descripción ...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 300,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Salidas a la Naturaleza" data-name="Salida personalizada a la roca" data-description="Servicio de Salida Personalizada a la Roca Descripción ..." data-price="COP 300,000">+</button>
                    </article>
                </div>
            </section>

            <section class="catalog-category mb-8">
                <div class="category-header flex items-center justify-between mb-3">
                    <h2 class="text-[18px] md:text-[22px] font-bold text-[#1b1b1b] m-0">Primera vez</h2>
                </div>

                <div class="space-y-3">
                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/entrenamiento dirigido.png" alt="Entrenamiento dirigido" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Entrenamiento dirigido</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">¡Bienvenidos a la experiencia de entrenamiento más em...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 70,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Primera vez" data-name="Entrenamiento dirigido" data-description="¡Bienvenidos a la experiencia de entrenamiento más em..." data-price="COP 70,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src=".//public/imagenes/escalada recreativa .png" alt="Día de escalada recreativa" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Día de escalada recreativa</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">Calentamiento en la zona de cueva 4 ascensos a ruta d...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 65,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Primera vez" data-name="Día de escalada recreativa" data-description="Calentamiento en la zona de cueva 4 ascensos a ruta d..." data-price="COP 65,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src=".//public/imagenes/escalada para los niños.png" alt="Clase para niños" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Clase para niños</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">La clase de escalada para niños es una actividad educa...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 60,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Primera vez" data-name="Clase para niños" data-description="La clase de escalada para niños es una actividad educa..." data-price="COP 60,000">+</button>
                    </article>
                </div>
            </section>

            <section class="catalog-category mb-8">
                <div class="category-header flex items-center justify-between mb-3">
                    <h2 class="text-[18px] md:text-[22px] font-bold text-[#1b1b1b] m-0">Todos los artículos</h2>
                </div>

                <div class="space-y-3">
                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="../rocopene/public/imagenes/cumple niños.png" alt="Cumpleaños niños" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Cumpleaños niños</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">¿Un cumpleaños aburrido? NO aquí. Regálale una e...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 80,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Todos los artículos" data-name="Cumpleaños niños" data-description="¿Un cumpleaños aburrido? NO aquí. Regálale una e..." data-price="COP 80,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/cumple adultos.png" alt="Cumpleaños para adultos" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Cumpleaños para adultos</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">¡Celebra tu cumpleaños de una forma diferente! ...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 95,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Todos los artículos" data-name="Cumpleaños para adultos" data-description="¡Celebra tu cumpleaños de una forma diferente! ..." data-price="COP 95,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/clase de yoga.png" alt="Clase de yoga grupal" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Clase de yoga grupal</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">¡Potencia tu rendimiento en la escalada con nuestras cli...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 60,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Todos los artículos" data-name="Clase de yoga grupal" data-description="¡Potencia tu rendimiento en la escalada con nuestras cli..." data-price="COP 60,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/curso de iniciacion.png" alt="Curso iniciación escalada deportiva" class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Curso iniciación escalada deportiva</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">5 clases con ascenso a nuestro muero de 10 metros + ...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 370,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Todos los artículos" data-name="Curso iniciación escalada deportiva" data-description="5 clases con ascenso a nuestro muero de 10 metros + ..." data-price="COP 370,000">+</button>
                    </article>

                    <article class="item-row flex items-center gap-3 rounded-[18px] bg-[#f8f8f8] px-2 py-2 md:px-3 md:py-3 transition hover:bg-[#f0f0f0]">
                        <div class="thumb w-[78px] h-[78px] md:w-[86px] md:h-[86px] rounded-[16px] flex-shrink-0 shadow-inner border border-white/40 overflow-hidden bg-cover bg-center bg-[#ececec]">
                            <img src="..//rocopene/public/imagenes/curso femenino.png" alt="Curso de entrenamiento femenino: Empodér..." class="w-full h-full object-cover opacity-90" onerror="this.style.display='none';">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="item-name text-[14px] md:text-[16px] font-normal text-[#222] leading-snug break-words">Curso de entrenamiento femenino: Empodér...</div>
                            <div class="item-description text-[#4b4b4b] text-[12px] md:text-[13px] leading-snug mt-1">¡Bienvenidos a la experiencia de entrenamiento que trans...</div>
                            <div class="item-price text-[#222] text-[12px] md:text-[14px] font-normal mt-1">COP 420,000</div>
                        </div>
                        <button type="button" aria-label="Ver detalles" class="plus-btn w-[38px] h-[38px] md:w-[42px] md:h-[42px] rounded-[12px] border border-[#d7d7d7] bg-white text-[#1d1d1d] text-[30px] leading-none flex items-center justify-center hover:border-[#9e9e9e] hover:bg-[#f4f4f4]" data-category="Todos los artículos" data-name="Curso de entrenamiento femenino: Empodér..." data-description="¡Bienvenidos a la experiencia de entrenamiento que trans..." data-price="COP 420,000">+</button>
                    </article>
                </div>
            </section>
        </div>
    </main>

    <div id="detalle-modal" class="fixed inset-0 z-50 hidden items-end justify-center bg-black/35 backdrop-blur-[2px] md:items-center">
        <div class="w-full max-w-xl rounded-t-[28px] md:rounded-[28px] bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p id="modal-category" class="text-xs font-bold uppercase tracking-[0.2em] text-[#1d9d72] mb-2"></p>
                    <h3 id="modal-title" class="text-2xl font-black text-[#111827]"></h3>
                </div>
                <button type="button" id="close-modal" class="text-3xl leading-none text-gray-500 hover:text-gray-800">×</button>
            </div>

            <div class="mb-4 rounded-2xl bg-[#f3f4f6] p-4">
                <p id="modal-price" class="text-2xl font-black text-[#111827]"></p>
                <p id="modal-description" class="mt-2 text-sm text-gray-600"></p>
            </div>

            <div class="mb-6">
                <h4 class="text-sm font-bold uppercase tracking-[0.18em] text-gray-500 mb-3">Especificaciones</h4>
                <ul id="modal-specs" class="space-y-2 text-sm text-gray-700"></ul>
            </div>

            <div class="flex gap-3">
                <button type="button" class="flex-1 rounded-full bg-[#22c55e] px-5 py-3 text-sm font-bold text-white hover:bg-[#16a34a] transition">Comprar</button>
                <button type="button" id="back-modal" class="flex-1 rounded-full border border-gray-300 bg-white px-5 py-3 text-sm font-bold text-gray-700 hover:bg-gray-100 transition">Atrás</button>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .font-heading {
            font-family: 'Orbitron', sans-serif;
        }
        .catalog-category + .catalog-category {
            margin-top: 20px;
        }
        .item-row {
            box-shadow: 0 1px 0 rgba(0,0,0,0.04);
            background: #f7f7f7;
        }
        .item-row:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .plus-btn {
            font-weight: 300;
            align-self: center;
        }
        @media (max-width: 768px) {
            .item-row {
                align-items: flex-start;
            }
            .thumb {
                width: 72px;
                height: 72px;
            }
        }
    </style>

    <script>
        const modal = document.getElementById('detalle-modal');
        const modalCategory = document.getElementById('modal-category');
        const modalTitle = document.getElementById('modal-title');
        const modalPrice = document.getElementById('modal-price');
        const modalDescription = document.getElementById('modal-description');
        const modalSpecs = document.getElementById('modal-specs');

        const specsByPackage = {
            'Escaladores': {
                'Día dificultad': ['Acceso a zona de escalada', 'Ideal para escaladores con experiencia', 'Reservación previa recomendada'],
                'Día dificultad + asegurador': ['Incluye asegurador profesional', 'Requiere equipo propio', 'Horario flexible según disponibilidad'],
                'Cueva o boulder': ['2 horas de acceso', 'Área de cueva o boulder', 'Perfecto para entrenamientos cortos']
            },
            'Salidas a la Naturaleza': {
                'Salida a la roca con el team ROCÓPOLIS DC': ['Guía especializado', 'Ruta guiada y segura', 'Incluye experiencia de salida completa'],
                'Día en la roca + equipo': ['Incluye equipo completo', 'Salida activa en roca', 'Ideal para principiantes y intermedios'],
                'Salida personalizada a la roca': ['Plan adaptado a tu nivel', 'Atención personalizada', 'Sugerencia de itinerario de roca']
            },
            'Primera vez': {
                'Entrenamiento dirigido': ['Técnica de iniciación', 'Instructor acompañante', 'Control de seguridad'],
                'Día de escalada recreativa': ['Calentamiento previo', '4 ascensos a ruta', 'Ambiente recreational y seguro'],
                'Clase para niños': ['Actividades adaptadas', 'Instructor con experiencia', 'Ideal para primera experiencia']
            },
            'Todos los artículos': {
                'Cumpleaños niños': ['Paquete para eventos infantiles', 'Atención personalizada', 'Experiencia lúdica y segura'],
                'Cumpleaños para adultos': ['Evento deportivo y social', 'Espacio para celebrar', 'Incluye logística y apoyo'],
                'Clase de yoga grupal': ['Rutina enfocada en movilidad', 'Mejora de rendimiento', 'Grupal y guiada'],
                'Curso iniciación escalada deportiva': ['5 clases de formación', 'Desarrollo técnico', 'Ideal para principiantes'],
                'Día de escalada recreativa': ['4 ascensos a ruta', 'Perfecto para un día activo', 'Incluye seguimiento de instructor'],
                'Clase para niños': ['Actividad educativa', 'Apto para edades jóvenes', 'Desarrollo de coordinación y confianza'],
                'Salida personalizada a la roca': ['Servicio a la medida', 'Experiencia exclusiva', 'Agenda según tus tiempos'],
                'Día en la roca + equipo': ['Equipos incluidos', 'Guía de uso y seguridad', 'Experiencia completa'],
                'Salida a la roca con el team ROCÓPOLIS DC': ['Guía especializada', 'Ruta adaptada al grupo', 'Aventura segura'],
                'Cueva o boulder': ['Sesión corta y efectiva', 'Área de práctica', 'Enfoque en técnica y resistencia'],
                'Día dificultad + asegurador': ['Asegurador incluido', 'Para escaladores avanzados', 'Ideal para práctica enfocada'],
                'Día dificultad': ['Rutas de nivel alto', 'Enfoque en técnica', 'Requiere experiencia previa'],
                'Curso de entrenamiento femenino: Empodér...': ['Entrenamiento guiado', 'Enfoque en fuerza y confianza', 'Ideal para mejorar rendimiento']
            }
        };

        function openModal(category, name, description, price) {
            const specs = specsByPackage[category]?.[name] || [
                'Servicio disponible con reserva previa',
                'Atención personalizada en recepción',
                'Ideal para disfrutar la experiencia completa'
            ];

            modalCategory.textContent = category;
            modalTitle.textContent = name;
            modalPrice.textContent = price;
            modalDescription.textContent = description;
            modalSpecs.innerHTML = specs.map(item => `<li class="flex items-center gap-2"><span class="inline-block h-2 w-2 rounded-full bg-[#1d9d72]"></span>${item}</li>`).join('');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.querySelectorAll('.plus-btn').forEach(button => {
            button.addEventListener('click', () => {
                openModal(
                    button.dataset.category,
                    button.dataset.name,
                    button.dataset.description,
                    button.dataset.price
                );
            });
        });

        document.getElementById('close-modal').addEventListener('click', closeModal);
        document.getElementById('back-modal').addEventListener('click', closeModal);
        modal.addEventListener('click', (event) => {
            if (event.target === modal) closeModal();
        });
    </script>

</body>
</html>
