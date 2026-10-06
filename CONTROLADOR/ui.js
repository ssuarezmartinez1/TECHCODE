/* =========================================================
   TECHCODE — UI.JS
   Reemplaza al antiguo session.js (que simulaba el login con
   localStorage). La sesión real ahora la maneja PHP en el
   servidor (ver MODELO/navbar_sesion.php y auth_guard.php).
   Este archivo SOLO contiene utilidades de interfaz:
   - Toast de aviso
   - Menú móvil (hamburguesa) de la navbar
========================================================= */

(function () {

    /* -----------------------------------------------------
       TOAST
    ----------------------------------------------------- */

    function mostrarToast(mensaje, duracion) {
        duracion = duracion || 2600;

        let toast = document.querySelector(".toast");
        if (!toast) {
            toast = document.createElement("div");
            toast.className = "toast";
            document.body.appendChild(toast);
        }

        toast.textContent = mensaje;
        toast.classList.add("toast-show");

        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => {
            toast.classList.remove("toast-show");
        }, duracion);
    }

    window.tcToast = mostrarToast;

    /* -----------------------------------------------------
       MENÚ MÓVIL
       Funciona con cualquier navbar que tenga:
         <button class="menu-btn" id="menuBtn">...</button>
         <nav id="navLinks"> ... </nav>
       (ver bloque .nav-mobile-open en shared.css)
    ----------------------------------------------------- */

    function iniciarMenuMovil() {
        const botones = document.querySelectorAll(".menu-btn");

        botones.forEach((btn) => {
            const header = btn.closest("header") || btn.closest(".navbar");
            const nav = header ? header.querySelector("nav") : null;
            if (!nav) return;

            btn.addEventListener("click", () => {
                const abierto = header.classList.toggle("nav-mobile-open");
                btn.classList.toggle("is-active", abierto);
                btn.setAttribute("aria-expanded", abierto ? "true" : "false");
            });

            nav.querySelectorAll("a").forEach((link) => {
                link.addEventListener("click", () => {
                    header.classList.remove("nav-mobile-open");
                    btn.classList.remove("is-active");
                    btn.setAttribute("aria-expanded", "false");
                });
            });
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", iniciarMenuMovil);
    } else {
        iniciarMenuMovil();
    }

})();
