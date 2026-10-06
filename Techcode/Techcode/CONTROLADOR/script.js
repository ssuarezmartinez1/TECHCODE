/* =========================================================
   TECHCODE — SCRIPT PRINCIPAL
   Funciones especiales de la página de inicio
========================================================= */

document.addEventListener("DOMContentLoaded", () => {


    /* =====================================================
       1. PRELOADER
    ===================================================== */

    const preloader = document.getElementById("preloader");

    if (preloader) {

        window.addEventListener("load", () => {

            setTimeout(() => {

                preloader.classList.add("preloader-hidden");

                setTimeout(() => preloader.remove(), 700);

            }, 450);

        });

    }


    /* =====================================================
       2. BARRA DE PROGRESO DE SCROLL
    ===================================================== */

    const scrollProgress = document.getElementById("scrollProgress");

    function updateScrollProgress() {

        if (!scrollProgress) return;

        const scrollTop = window.scrollY;
        const docHeight =
            document.documentElement.scrollHeight - window.innerHeight;

        const percent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

        scrollProgress.style.width = `${percent}%`;

    }


    /* =====================================================
       3. NAVBAR: ENCOGER AL HACER SCROLL + LINK ACTIVO
    ===================================================== */

    const navbar = document.getElementById("navbar");
    const backToTop = document.getElementById("backToTop");

    function updateNavbarOnScroll() {

        if (!navbar) return;

        if (window.scrollY > 40) {
            navbar.classList.add("navbar-scrolled");
        } else {
            navbar.classList.remove("navbar-scrolled");
        }

        if (backToTop) {

            if (window.scrollY > 600) {
                backToTop.classList.add("show");
            } else {
                backToTop.classList.remove("show");
            }

        }

    }


    window.addEventListener("scroll", () => {

        updateScrollProgress();
        updateNavbarOnScroll();

    }, { passive: true });

    updateScrollProgress();
    updateNavbarOnScroll();


    if (backToTop) {

        backToTop.addEventListener("click", () => {

            window.scrollTo({ top: 0, behavior: "smooth" });

        });

    }


    /* =====================================================
       4. MENÚ MÓVIL
    ===================================================== */

    const menuBtn = document.getElementById("menuBtn");
    const navLinks = document.getElementById("navLinks");

    if (menuBtn && navLinks) {

        menuBtn.addEventListener("click", () => {

            navLinks.classList.toggle("nav-open");
            menuBtn.classList.toggle("menu-open");

        });

        navLinks.querySelectorAll("a").forEach(link => {

            link.addEventListener("click", () => {

                navLinks.classList.remove("nav-open");
                menuBtn.classList.remove("menu-open");

            });

        });

    }


    /* =====================================================
       5. RESALTAR SECCIÓN ACTIVA EN NAV AL HACER SCROLL
    ===================================================== */

    const sectionsForNav = document.querySelectorAll(
        "section[id]"
    );

    const navAnchorLinks = document.querySelectorAll(
        "nav a[data-section]"
    );

    if (sectionsForNav.length && navAnchorLinks.length) {

        const navObserver = new IntersectionObserver(

            entries => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        navAnchorLinks.forEach(link =>
                            link.classList.remove("active")
                        );

                        const match = document.querySelector(
                            `nav a[data-section="${entry.target.id}"]`
                        );

                        if (match) match.classList.add("active");

                    }

                });

            },

            { threshold: 0.4, rootMargin: "-90px 0px -50% 0px" }

        );

        sectionsForNav.forEach(section => navObserver.observe(section));

    }


    /* =====================================================
       6. CURSOR PERSONALIZADO (solo dispositivos con mouse)
    ===================================================== */

    const cursorDot = document.getElementById("cursorDot");
    const cursorRing = document.getElementById("cursorRing");
    const hasFinePointer = window.matchMedia("(pointer: fine)").matches;

    if (cursorDot && cursorRing && hasFinePointer) {

        document.body.classList.add("has-custom-cursor");

        let ringX = 0, ringY = 0, targetX = 0, targetY = 0;

        document.addEventListener("mousemove", e => {

            cursorDot.style.left = `${e.clientX}px`;
            cursorDot.style.top = `${e.clientY}px`;

            targetX = e.clientX;
            targetY = e.clientY;

        });

        function animateRing() {

            ringX += (targetX - ringX) * 0.18;
            ringY += (targetY - ringY) * 0.18;

            cursorRing.style.left = `${ringX}px`;
            cursorRing.style.top = `${ringY}px`;

            requestAnimationFrame(animateRing);

        }

        animateRing();

        const hoverTargets = document.querySelectorAll(
            "a, button, .purpose-card, .service-item, .faq-question, .testi-card"
        );

        hoverTargets.forEach(el => {

            el.addEventListener("mouseenter", () =>
                cursorRing.classList.add("cursor-ring-hover")
            );

            el.addEventListener("mouseleave", () =>
                cursorRing.classList.remove("cursor-ring-hover")
            );

        });

    } else if (cursorDot && cursorRing) {

        cursorDot.style.display = "none";
        cursorRing.style.display = "none";

    }


    /* =====================================================
       7. FONDO DE PARTÍCULAS (constelación) EN EL HERO
    ===================================================== */

    const canvas = document.getElementById("particleCanvas");

    if (canvas && !window.matchMedia("(prefers-reduced-motion: reduce)").matches) {

        const ctx = canvas.getContext("2d");
        let particles = [];
        let width, height;

        function resizeCanvas() {

            width = canvas.width = window.innerWidth;
            height = canvas.height = Math.max(window.innerHeight, 700);

        }

        function createParticles() {

            const count = Math.min(70, Math.floor(width / 22));

            particles = Array.from({ length: count }, () => ({

                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.35,
                vy: (Math.random() - 0.5) * 0.35,
                r: Math.random() * 1.6 + 0.6

            }));

        }

        function drawParticles() {

            ctx.clearRect(0, 0, width, height);

            for (let i = 0; i < particles.length; i++) {

                const p = particles[i];

                p.x += p.vx;
                p.y += p.vy;

                if (p.x < 0 || p.x > width) p.vx *= -1;
                if (p.y < 0 || p.y > height) p.vy *= -1;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = "rgba(255,120,40,0.55)";
                ctx.fill();

                for (let j = i + 1; j < particles.length; j++) {

                    const q = particles[j];
                    const dx = p.x - q.x;
                    const dy = p.y - q.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < 140) {

                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(q.x, q.y);
                        ctx.strokeStyle = `rgba(255,90,0,${0.12 * (1 - dist / 140)})`;
                        ctx.lineWidth = 1;
                        ctx.stroke();

                    }

                }

            }

            requestAnimationFrame(drawParticles);

        }

        resizeCanvas();
        createParticles();
        drawParticles();

        let resizeTimeout;

        window.addEventListener("resize", () => {

            clearTimeout(resizeTimeout);

            resizeTimeout = setTimeout(() => {

                resizeCanvas();
                createParticles();

            }, 200);

        });

    }


    /* =====================================================
       8. PALABRAS ROTATIVAS EN EL HERO
    ===================================================== */

    const rotatingWrapper = document.querySelector(".rotating-word");

    if (rotatingWrapper) {

        const words = rotatingWrapper.querySelectorAll(".word");
        let currentWord = 0;

        if (words.length > 1) {

            setInterval(() => {

                words[currentWord].classList.remove("word-active");
                words[currentWord].classList.add("word-exit");

                const previous = currentWord;
                currentWord = (currentWord + 1) % words.length;

                words[currentWord].classList.add("word-active");

                setTimeout(() => {

                    words[previous].classList.remove("word-exit");

                }, 500);

            }, 2800);

        }

    }


    /* =====================================================
       9. MOVIMIENTO SUAVE DEL LOGO DEL HERO
    ===================================================== */

    const hero = document.querySelector(".hero");
    const heroLogo = document.querySelector(".hero-logo-wrapper");

    if (hero && heroLogo) {

        hero.addEventListener("mousemove", event => {

            const x = (window.innerWidth / 2 - event.clientX) / 45;
            const y = (window.innerHeight / 2 - event.clientY) / 45;

            heroLogo.style.transform = `translate(${x}px, ${y}px)`;

        });

        hero.addEventListener("mouseleave", () => {

            heroLogo.style.transform = "translate(0, 0)";

        });

    }


    /* =====================================================
       10. BRILLO SIGUIENDO EL CURSOR EN TARJETAS
    ===================================================== */

    document.querySelectorAll(".purpose-card, .stat-card, .testi-card").forEach(card => {

        card.addEventListener("mousemove", event => {

            const rect = card.getBoundingClientRect();

            card.style.setProperty("--mouse-x", `${event.clientX - rect.left}px`);
            card.style.setProperty("--mouse-y", `${event.clientY - rect.top}px`);

        });

    });


    /* =====================================================
       11. BOTONES MAGNÉTICOS
    ===================================================== */

    document.querySelectorAll(
        ".hero-button, .contact-button, .login-btn"
    ).forEach(btn => {

        btn.addEventListener("mousemove", e => {

            const rect = btn.getBoundingClientRect();

            const x = (e.clientX - rect.left - rect.width / 2) * 0.25;
            const y = (e.clientY - rect.top - rect.height / 2) * 0.35;

            btn.style.transform = `translate(${x}px, ${y}px)`;

        });

        btn.addEventListener("mouseleave", () => {

            btn.style.transform = "translate(0, 0)";

        });

    });


    /* =====================================================
       12. APARICIÓN DE ELEMENTOS AL HACER SCROLL
    ===================================================== */

    const animatedElements = document.querySelectorAll(
        ".about-content, .purpose-card, .service-item, .services-header, " +
        ".contact-content, .stat-card, .testimonials-header, .testi-card, " +
        ".faq-header, .faq-item"
    );

    const revealObserver = new IntersectionObserver(

        entries => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    entry.target.classList.add("show");

                }

            });

        },

        { threshold: 0.12 }

    );

    animatedElements.forEach(el => revealObserver.observe(el));


    /* =====================================================
       13. CONTADORES ANIMADOS (RESULTADOS)
    ===================================================== */

    const statNumbers = document.querySelectorAll(".stat-number");

    function animateCount(el) {

        const target = parseInt(el.dataset.count, 10) || 0;
        const suffix = el.dataset.suffix || "";
        const duration = 1600;
        const start = performance.now();

        function step(now) {

            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const value = Math.floor(eased * target);

            el.textContent = value + suffix;

            if (progress < 1) {

                requestAnimationFrame(step);

            } else {

                el.textContent = target + suffix;

            }

        }

        requestAnimationFrame(step);

    }

    if (statNumbers.length) {

        const countObserver = new IntersectionObserver(

            entries => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        animateCount(entry.target);
                        countObserver.unobserve(entry.target);

                    }

                });

            },

            { threshold: 0.5 }

        );

        statNumbers.forEach(el => countObserver.observe(el));

    }


    /* =====================================================
       14. CARRUSEL DE TESTIMONIOS
    ===================================================== */

    const track = document.getElementById("testimonialsTrack");
    const dotsWrap = document.getElementById("testimonialsDots");
    const prevBtn = document.getElementById("testiPrev");
    const nextBtn = document.getElementById("testiNext");

    if (track && dotsWrap) {

        const cards = track.querySelectorAll(".testi-card");
        let current = 0;
        let autoplayTimer;

        cards.forEach((_, i) => {

            const dot = document.createElement("button");

            dot.classList.add("testi-dot");
            dot.setAttribute("aria-label", `Ir al testimonio ${i + 1}`);

            if (i === 0) dot.classList.add("active");

            dot.addEventListener("click", () => goToSlide(i));

            dotsWrap.appendChild(dot);

        });

        const dots = dotsWrap.querySelectorAll(".testi-dot");

        function goToSlide(index) {

            current = (index + cards.length) % cards.length;

            track.style.transform = `translateX(-${current * 100}%)`;

            dots.forEach(d => d.classList.remove("active"));
            dots[current].classList.add("active");

        }

        function startAutoplay() {

            clearInterval(autoplayTimer);

            autoplayTimer = setInterval(() => goToSlide(current + 1), 5500);

        }

        if (prevBtn) prevBtn.addEventListener("click", () => {
            goToSlide(current - 1);
            startAutoplay();
        });

        if (nextBtn) nextBtn.addEventListener("click", () => {
            goToSlide(current + 1);
            startAutoplay();
        });

        goToSlide(0);
        startAutoplay();

    }


    /* =====================================================
       15. ACORDEÓN DE PREGUNTAS FRECUENTES
    ===================================================== */

    document.querySelectorAll(".faq-item").forEach(item => {

        const question = item.querySelector(".faq-question");
        const answer = item.querySelector(".faq-answer");

        if (!question || !answer) return;

        answer.style.maxHeight = "0px";

        question.addEventListener("click", () => {

            const isOpen = item.classList.contains("faq-open");

            document.querySelectorAll(".faq-item").forEach(other => {

                other.classList.remove("faq-open");
                other.querySelector(".faq-answer").style.maxHeight = "0px";

            });

            if (!isOpen) {

                item.classList.add("faq-open");
                answer.style.maxHeight = `${answer.scrollHeight + 20}px`;

            }

        });

    });


    /* =====================================================
       16. TOAST DE NOTIFICACIÓN
    ===================================================== */

    const toast = document.getElementById("toast");
    let toastTimeout;

    function showToast(message) {

        if (!toast) return;

        toast.textContent = message;
        toast.classList.add("toast-show");

        clearTimeout(toastTimeout);

        toastTimeout = setTimeout(() => {

            toast.classList.remove("toast-show");

        }, 2600);

    }


    /* =====================================================
       17. COPIAR CORREO AL PORTAPAPELES
    ===================================================== */

    const copyEmailBtn = document.getElementById("copyEmailBtn");

    if (copyEmailBtn) {

        copyEmailBtn.addEventListener("click", async () => {

            const email = copyEmailBtn.dataset.email;

            try {

                await navigator.clipboard.writeText(email);
                showToast("Correo copiado al portapapeles ✓");

            } catch (err) {

                showToast("No se pudo copiar el correo");

            }

        });

    }

});

/* =========================================================
   TECHCODE FUTURE EDITION 2.0
   Microinteracciones premium
========================================================= */
(function(){
  const init = () => {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce) return;

    // Capas atmosféricas
    ['a1','a2'].forEach(c => {
      const el=document.createElement('div');
      el.className='tc-aurora '+c;
      document.body.appendChild(el);
    });

    const spot=document.createElement('div');
    spot.className='tc-spotlight';
    document.body.appendChild(spot);

    let sx=innerWidth/2, sy=innerHeight/2, tx=sx, ty=sy;
    window.addEventListener('mousemove',e=>{tx=e.clientX;ty=e.clientY},{passive:true});
    const moveSpot=()=>{
      sx+=(tx-sx)*.10; sy+=(ty-sy)*.10;
      spot.style.left=sx+'px'; spot.style.top=sy+'px';
      requestAnimationFrame(moveSpot);
    };
    moveSpot();

    // Botones magnéticos sutiles
    document.querySelectorAll('.hero-button,.login-btn,.line-button,.back-to-top').forEach(btn=>{
      btn.addEventListener('mousemove',e=>{
        const r=btn.getBoundingClientRect();
        const x=(e.clientX-(r.left+r.width/2))/r.width;
        const y=(e.clientY-(r.top+r.height/2))/r.height;
        btn.style.transform=`translate(${x*6}px,${y*6}px)`;
      });
      btn.addEventListener('mouseleave',()=>btn.style.transform='');
    });

    // Tilt 3D en tarjetas
    document.querySelectorAll('.purpose-card,.service-item,.stat-card,.testi-card').forEach(card=>{
      card.classList.add('tc-tilt');
      card.addEventListener('mousemove',e=>{
        const r=card.getBoundingClientRect();
        const px=(e.clientX-r.left)/r.width;
        const py=(e.clientY-r.top)/r.height;
        const rx=(.5-py)*5;
        const ry=(px-.5)*6;
        card.style.setProperty('--mx',`${px*100}%`);
        card.style.setProperty('--my',`${py*100}%`);
        card.style.transform=`perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-7px)`;
      });
      card.addEventListener('mouseleave',()=>card.style.transform='');
    });

    // Parallax suave del fondo con el mouse
    const grid=document.querySelector('.grid-background');
    if(grid){
      window.addEventListener('mousemove',e=>{
        const x=(e.clientX/innerWidth-.5)*10;
        const y=(e.clientY/innerHeight-.5)*10;
        grid.style.transform=`translate(${x}px,${y}px)`;
      },{passive:true});
    }

    // Añade clases para entrada hero escalonada
    const heroText=document.querySelector('.hero-text');
    if(heroText) heroText.classList.add('tc-stagger');
  };
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',init,{once:true});
  else init();
})();
