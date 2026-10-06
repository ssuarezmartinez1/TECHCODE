
/* =========================================================
   TECHCODE PINK PIANO
   Juego de teclas con A, S, D y F
========================================================= */

document.addEventListener("DOMContentLoaded", () => {

    // ELEMENTOS
    const board = document.getElementById("pianoBoard");
    const gameArea = document.querySelector(".game-area");

    const status = document.getElementById("status");
    const scoreDisplay = document.getElementById("score");
    const bestDisplay = document.getElementById("best");
    const message = document.getElementById("message");

    const startBtn = document.getElementById("startBtn");
    const pauseBtn = document.getElementById("pauseBtn");
    const resetBtn = document.getElementById("resetBtn");

    if (!board || !gameArea || !status || !scoreDisplay ||
        !bestDisplay || !message || !startBtn ||
        !pauseBtn || !resetBtn) {
        console.error("No se encontraron los elementos del juego.");
        return;
    }

    // CONFIGURACIÓN
    const KEYS = ["a", "d", "z", "c"];
    const TILE_HEIGHT = 92;
    const HIT_LINE = 0.82;
    const HIT_TOLERANCE = 80;
    const INITIAL_SPEED = 110;
    const INITIAL_SPAWN_INTERVAL = 1400;

    let score = 0;
    let best = 0;

    let playing = false;
    let paused = false;
    let gameOver = false;

    let tiles = [];
    let animationId = null;

    let lastTime = 0;
    let spawnTimer = 0;
    let spawnInterval = INITIAL_SPAWN_INTERVAL;

    // RÉCORD
    try {
        best = Number(
            localStorage.getItem("techcodePinkPianoBest")
        ) || 0;
    } catch (error) {
        best = 0;
    }

    updateDisplays();

    // PUNTUACIÓN
    function updateDisplays() {
        scoreDisplay.textContent = String(score).padStart(4, "0");
        bestDisplay.textContent = String(best).padStart(4, "0");
    }

    function showMessage(text) {
        message.textContent = text;
        message.classList.remove("hidden");
    }

    function hideMessage() {
        message.classList.add("hidden");
    }

    function saveBest() {
        if (score > best) {
            best = score;

            try {
                localStorage.setItem(
                    "techcodePinkPianoBest",
                    String(best)
                );
            } catch (error) {
                console.warn("No se pudo guardar el récord.");
            }
        }

        updateDisplays();
    }

    // LÍNEA DE ACIERTO
    function getHitLineY() {
        return gameArea.clientHeight * HIT_LINE;
    }

    // CREAR TECLA EN UNA DE LAS CUATRO COLUMNAS
    function createTile() {
        if (!playing || paused || gameOver) return;

        const laneIndex = Math.floor(Math.random() * 4);

        const tile = document.createElement("button");
        tile.type = "button";
        tile.className = "tile";

        tile.setAttribute(
            "aria-label",
            `Tecla ${KEYS[laneIndex].toUpperCase()}`
        );

        tile.dataset.lane = laneIndex;

        /*
         * IMPORTANTE:
         * Cada tecla tiene una posición horizontal propia.
         * 0 = A, 1 = d, 2 = z, 3 = c.
         */
        tile.style.left = `calc(${laneIndex * 25}% + 5px)`;
        tile.style.right = "auto";
        tile.style.width = "calc(25% - 14px)";

        tile.style.top = `-${TILE_HEIGHT}px`;
        tile.style.height = `${TILE_HEIGHT}px`;

        board.appendChild(tile);

        const tileData = {
            element: tile,
            lane: laneIndex,
            y: -TILE_HEIGHT,
            hit: false
        };

        tiles.push(tileData);

        // Clic en la tecla
        tile.addEventListener("click", () => {
            hitLane(laneIndex);
        });
    }

    // PRESIONAR COLUMNA
    function hitLane(laneIndex) {
        if (!playing || paused || gameOver) return;

        const hitLineY = getHitLineY();

        let candidate = null;
        let smallestDistance = Infinity;

        for (const tile of tiles) {
            if (tile.lane !== laneIndex || tile.hit) continue;

            // Se compara el centro de la tecla con la línea.
            const tileCenter = tile.y + TILE_HEIGHT / 2;
            const distance = Math.abs(tileCenter - hitLineY);

            if (distance < smallestDistance) {
                smallestDistance = distance;
                candidate = tile;
            }
        }

        if (!candidate) return;
        if (smallestDistance > HIT_TOLERANCE) return;

        // ACIERTO
        candidate.hit = true;
        candidate.element.classList.add("hit");

        score += 100;

        // La dificultad aumenta poco a poco.
        spawnInterval = Math.max(
            750,
            INITIAL_SPAWN_INTERVAL -
                Math.floor(score / 500) * 50
        );

        updateDisplays();

        candidate.element.remove();

        tiles = tiles.filter(tile => tile !== candidate);
    }

    // FINALIZAR
    function endGame() {
        if (gameOver) return;

        playing = false;
        paused = false;
        gameOver = true;

        cancelAnimationFrame(animationId);

        status.textContent = "GAME OVER";
        startBtn.textContent = "JUGAR OTRA VEZ";
        pauseBtn.textContent = "PAUSAR";

        saveBest();

        showMessage(
            `¡FALLASTE! PUNTOS: ${score} · PRESIONA JUGAR OTRA VEZ`
        );
    }

    // BUCLE DEL JUEGO
    function gameLoop(timestamp) {
        if (!playing || paused || gameOver) return;

        if (lastTime === 0) lastTime = timestamp;

        const delta = Math.min(timestamp - lastTime, 50);
        lastTime = timestamp;

        const hitLineY = getHitLineY();

        // Generar nuevas teclas
        spawnTimer += delta;

        if (spawnTimer >= spawnInterval) {
            spawnTimer -= spawnInterval;
            createTile();
        }

        // Velocidad de caída
        const speed =
            INITIAL_SPEED + Math.floor(score / 500) * 8;

        for (const tile of [...tiles]) {
            if (tile.hit) continue;

            tile.y += speed * delta / 1000;
            tile.element.style.top = `${tile.y}px`;

            /*
             * La tecla falla cuando su centro ha pasado
             * la línea de presión y termina la tolerancia.
             */
            const tileCenter = tile.y + TILE_HEIGHT / 2;

            if (tileCenter > hitLineY + HIT_TOLERANCE) {
                endGame();
                return;
            }
        }

        animationId = requestAnimationFrame(gameLoop);
    }

    // INICIAR
    function startGame() {
        if (playing && !paused) return;

        if (gameOver) resetGame();

        playing = true;
        paused = false;
        gameOver = false;

        lastTime = 0;

        status.textContent = "JUGANDO";
        startBtn.textContent = "JUEGO EN CURSO";
        pauseBtn.textContent = "PAUSAR";

        hideMessage();

        cancelAnimationFrame(animationId);
        animationId = requestAnimationFrame(gameLoop);
    }

    // PAUSAR / CONTINUAR
    function togglePause() {
        if (!playing || gameOver) return;

        if (!paused) {
            paused = true;

            cancelAnimationFrame(animationId);

            status.textContent = "PAUSADO";
            pauseBtn.textContent = "CONTINUAR";

            showMessage("JUEGO PAUSADO");
        } else {
            paused = false;
            lastTime = 0;

            status.textContent = "JUGANDO";
            pauseBtn.textContent = "PAUSAR";

            hideMessage();

            animationId = requestAnimationFrame(gameLoop);
        }
    }

    // REINICIAR
    function resetGame() {
        cancelAnimationFrame(animationId);

        playing = false;
        paused = false;
        gameOver = false;

        score = 0;
        spawnTimer = 0;
        spawnInterval = INITIAL_SPAWN_INTERVAL;
        lastTime = 0;

        tiles.forEach(tile => tile.element.remove());
        tiles = [];

        board.querySelectorAll(".tile").forEach(tile => tile.remove());

        status.textContent = "LISTO";
        startBtn.textContent = "INICIAR JUEGO";
        pauseBtn.textContent = "PAUSAR";

        updateDisplays();

        showMessage("PRESIONA INICIAR PARA JUGAR");
    }

    // TECLADO
    document.addEventListener("keydown", event => {
        if (event.repeat) return;

        const key = event.key.toLowerCase();
        const laneIndex = KEYS.indexOf(key);

        if (laneIndex !== -1) {
            event.preventDefault();
            hitLane(laneIndex);
        }

        if (event.code === "Space") {
            event.preventDefault();
            togglePause();
        }
    });

    // BOTONES
    startBtn.addEventListener("click", startGame);
    pauseBtn.addEventListener("click", togglePause);
    resetBtn.addEventListener("click", resetGame);

    // INICIAR EN ESTADO LIMPIO
    resetGame();
});