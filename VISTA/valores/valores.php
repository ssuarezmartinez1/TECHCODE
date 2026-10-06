<?php require_once __DIR__ . '/../../MODELO/navbar_sesion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Valores | TechCode</title>
<link rel="stylesheet" href="../nosotros/nosotros.css">
<link rel="stylesheet" href="valores.css">
<link rel="stylesheet" href="../shared.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="tc-inner-page">
<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<main>
<!-- =====================================================
     VALORES
===================================================== -->

<section class="values values-page">


    <div class="values-header">

        <span class="eyebrow">
            // NUESTROS VALORES
        </span>

        <h2>

            Lo que nos
            <span>
                define.
            </span>

        </h2>

        <p>

            Nuestros valores hacen parte de la manera
            en que pensamos, diseñamos y desarrollamos
            cada proyecto.

        </p>

    </div>



    <div class="values-carousel">
        <button class="values-arrow values-prev" type="button" aria-label="Valores anteriores">‹</button>
        <div class="values-grid">


        <article class="value">

            <span>
                01
            </span>

            <div class="value-icon">
                +
            </div>

            <h3>
                Innovación
            </h3>

            <p>

                Buscamos nuevas ideas y formas de utilizar
                la tecnología para crear mejores soluciones.

            </p>

        </article>



        <article class="value">

            <span>
                02
            </span>

            <div class="value-icon">
                ✦
            </div>

            <h3>
                Creatividad
            </h3>

            <p>

                Utilizamos la creatividad para encontrar
                alternativas diferentes ante cada desafío.

            </p>

        </article>



        <article class="value">

            <span>
                03
            </span>

            <div class="value-icon">
                ✓
            </div>

            <h3>
                Compromiso
            </h3>

            <p>

                Trabajamos con responsabilidad para cumplir
                los objetivos de cada proyecto.

            </p>

        </article>



        <article class="value">

            <span>
                04
            </span>

            <div class="value-icon">
                ◆
            </div>

            <h3>
                Calidad
            </h3>

            <p>

                Buscamos que nuestros productos sean
                funcionales, claros y eficientes.

            </p>

        </article>



        <article class="value">

            <span>
                05
            </span>

            <div class="value-icon">
                #
            </div>

            <h3>
                Trabajo en equipo
            </h3>

            <p>

                Creemos que compartir conocimientos y
                trabajar juntos permite obtener mejores
                resultados.

            </p>

        </article>



        <article class="value">

            <span>
                06
            </span>

            <div class="value-icon">
                →
            </div>

            <h3>
                Aprendizaje
            </h3>

            <p>

                Cada proyecto es una oportunidad para
                aprender, mejorar y seguir creciendo.

            </p>

        </article>

        </div>
        <button class="values-arrow values-next" type="button" aria-label="Siguientes valores">›</button>
    </div>

    <div class="values-dots" aria-label="Navegación de valores"></div>

</section>




</main>
<footer>
    <div class="footer-logo">
        <a href="../index.php" class="logo"><span>TECH</span><strong>CODE</strong></a>
        <p>Tecnología que convierte ideas en soluciones.</p>
    </div>
    <div class="footer-info"><span>© 2026 TechCode</span><span>Desarrollo · Innovación · Tecnología</span></div>
</footer>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector('.values-grid');
    const cards = [...document.querySelectorAll('.value')];
    const prev = document.querySelector('.values-prev');
    const next = document.querySelector('.values-next');
    const dots = document.querySelector('.values-dots');
    if (!track || !cards.length) return;
    let index = 0;
    let timer;
    const getVisible = () => window.innerWidth <= 700 ? 1 : (window.innerWidth <= 1000 ? 2 : 3);
    const renderDots = () => {
        dots.innerHTML = '';
        const pages = Math.ceil(cards.length / getVisible());
        for (let i=0;i<pages;i++) {
            const b=document.createElement('button'); b.type='button'; b.setAttribute('aria-label','Ir al grupo '+(i+1));
            b.addEventListener('click',()=>{index=i; update(); restart();}); dots.appendChild(b);
        }
    };
    const update = () => {
        const visible=getVisible(); const pages=Math.ceil(cards.length/visible); index=Math.max(0,Math.min(index,pages-1));
        track.style.transform=`translateX(-${index*100}%)`;
        [...dots.children].forEach((b,i)=>b.classList.toggle('active',i===index));
    };
    const restart=()=>{clearInterval(timer); timer=setInterval(()=>{index=(index+1)%Math.ceil(cards.length/getVisible()); update();},4500);};
    prev.addEventListener('click',()=>{index=(index-1+Math.ceil(cards.length/getVisible()))%Math.ceil(cards.length/getVisible());update();restart();});
    next.addEventListener('click',()=>{index=(index+1)%Math.ceil(cards.length/getVisible());update();restart();});
    window.addEventListener('resize',()=>{renderDots(); update();});
    renderDots(); update(); restart();
});
</script>
<script src="../../CONTROLADOR/ui.js"></script>
</body>
</html>