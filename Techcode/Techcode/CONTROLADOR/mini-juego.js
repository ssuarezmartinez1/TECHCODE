const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

const scoreText = document.getElementById("score");
const highScoreText = document.getElementById("highScore");

const startScreen = document.getElementById("startScreen");
const gameOverScreen = document.getElementById("gameOverScreen");

const startBtn = document.getElementById("startBtn");
const restartBtn = document.getElementById("restartBtn");
const finalScore = document.getElementById("finalScore");

const WIDTH = canvas.width;
const HEIGHT = canvas.height;

// ===============================
// ESTADO DEL JUEGO
// ===============================

let gameRunning = false;
let score = 0;
let level = 1;
let frame = 0;

let highScore = Number(localStorage.getItem("techcodeHighScore")) || 0;
highScoreText.textContent = highScore;

// ===============================
// JUGADOR
// ===============================

const player = {
    x: 80,
    y: HEIGHT / 2,
    width: 42,
    height: 30,

    speed: 6,

    dx: 0,
    dy: 0
};

// ===============================
// TECLAS
// ===============================

const keys = {
    ArrowLeft: false,
    ArrowRight: false,
    ArrowUp: false,
    ArrowDown: false,

    w: false,
    a: false,
    s: false,
    d: false
};

document.addEventListener("keydown", (e) => {

    const key = e.key.length === 1
        ? e.key.toLowerCase()
        : e.key;

    if (Object.prototype.hasOwnProperty.call(keys, key)) {
        keys[key] = true;
        e.preventDefault();
    }

    if (e.code === "Space" && !gameRunning) {
        startGame();
    }
});

document.addEventListener("keyup", (e) => {

    const key = e.key.length === 1
        ? e.key.toLowerCase()
        : e.key;

    if (Object.prototype.hasOwnProperty.call(keys, key)) {
        keys[key] = false;
        e.preventDefault();
    }
});

window.addEventListener("blur", () => {
    Object.keys(keys).forEach(key => {
        keys[key] = false;
    });
});

// ===============================
// ESTRELLAS
// ===============================

const stars = [];

for (let i = 0; i < 100; i++) {

    stars.push({
        x: Math.random() * WIDTH,
        y: Math.random() * HEIGHT,
        size: Math.random() * 2 + 1,
        speed: Math.random() * 2 + 0.5
    });
}

// ===============================
// OBSTÁCULOS
// ===============================

let obstacles = [];

function createObstacle() {

    const size = Math.random() * 25 + 25;

    obstacles.push({
        x: WIDTH + size,
        y: Math.random() * (HEIGHT - size),

        width: size,
        height: size,

        speed:
            5 +
            level * 0.8 +
            Math.random() * 3,

        verticalSpeed:
            (Math.random() - 0.5) * (1.5 + level * 0.25),

        rotation: Math.random() * Math.PI,

        type: Math.random() < 0.25 ? "moving" : "normal"
    });
}

// ===============================
// OBSTÁCULOS ESPECIALES
// ===============================

function createFastObstacle() {

    const size = 22 + Math.random() * 20;

    obstacles.push({

        x: WIDTH + size,

        y: Math.random() * (HEIGHT - size),

        width: size,
        height: size,

        speed: 10 + level * 0.7,

        verticalSpeed:
            (Math.random() - 0.5) * 4,

        rotation: 0,

        type: "fast"
    });
}

// ===============================
// ACTUALIZAR JUGADOR
// ===============================

function updatePlayer() {

    player.dx = 0;
    player.dy = 0;

    if (keys.ArrowLeft || keys.a) {
        player.dx = -player.speed;
    }

    if (keys.ArrowRight || keys.d) {
        player.dx = player.speed;
    }

    if (keys.ArrowUp || keys.w) {
        player.dy = -player.speed;
    }

    if (keys.ArrowDown || keys.s) {
        player.dy = player.speed;
    }

    player.x += player.dx;
    player.y += player.dy;

    // Límites

    if (player.x < 10) {
        player.x = 10;
    }

    if (player.x + player.width > WIDTH - 10) {
        player.x = WIDTH - player.width - 10;
    }

    if (player.y < 10) {
        player.y = 10;
    }

    if (player.y + player.height > HEIGHT - 10) {
        player.y = HEIGHT - player.height - 10;
    }
}

// ===============================
// ACTUALIZAR ESTRELLAS
// ===============================

function updateStars() {

    stars.forEach(star => {

        star.x -= star.speed + level * 0.1;

        if (star.x < 0) {

            star.x = WIDTH;

            star.y = Math.random() * HEIGHT;
        }
    });
}

// ===============================
// ACTUALIZAR OBSTÁCULOS
// ===============================

function updateObstacles() {

    obstacles.forEach(obstacle => {

        obstacle.x -= obstacle.speed;

        // Algunos obstáculos se mueven verticalmente

        if (
            obstacle.type === "moving" ||
            obstacle.type === "fast"
        ) {

            obstacle.y += obstacle.verticalSpeed;

            if (
                obstacle.y <= 0 ||
                obstacle.y + obstacle.height >= HEIGHT
            ) {

                obstacle.verticalSpeed *= -1;
            }
        }

        obstacle.rotation += 0.05;
    });

    obstacles = obstacles.filter(
        obstacle => obstacle.x + obstacle.width > -50
    );
}

// ===============================
// COLISIÓN
// ===============================

function collision(a, b) {

    return (
        a.x < b.x + b.width &&
        a.x + a.width > b.x &&
        a.y < b.y + b.height &&
        a.y + a.height > b.y
    );
}

// ===============================
// COMPROBAR COLISIONES
// ===============================

function checkCollisions() {

    for (const obstacle of obstacles) {

        // Hacemos la zona de impacto ligeramente menor
        // para que el juego sea difícil pero justo.

        const hitbox = {

            x: player.x + 6,
            y: player.y + 5,

            width: player.width - 12,
            height: player.height - 10
        };

        if (collision(hitbox, obstacle)) {

            gameOver();

            return;
        }
    }
}

// ===============================
// CREAR OBSTÁCULOS
// ===============================

function spawnObstacles() {

    let spawnRate = Math.max(
        16,
        48 - level * 3
    );

    if (frame % spawnRate === 0) {

        createObstacle();

        // Nivel 3+
        if (
            level >= 3 &&
            Math.random() < 0.65
        ) {

            createObstacle();
        }

        // Nivel 5+
        if (
            level >= 5 &&
            Math.random() < 0.55
        ) {

            createObstacle();
        }

        // Nivel 8+
        if (
            level >= 8 &&
            Math.random() < 0.5
        ) {

            createFastObstacle();
        }
    }
}

// ===============================
// DIBUJAR ESTRELLAS
// ===============================

function drawStars() {

    stars.forEach(star => {

        ctx.fillStyle = "white";

        ctx.fillRect(
            star.x,
            star.y,
            star.size,
            star.size
        );
    });
}

// ===============================
// DIBUJAR JUGADOR
// ===============================

function drawPlayer() {

    ctx.save();

    ctx.translate(
        player.x + player.width / 2,
        player.y + player.height / 2
    );

    // Nave

    ctx.fillStyle = "#ff7135";

    ctx.beginPath();

    ctx.moveTo(22, 0);
    ctx.lineTo(-15, -14);
    ctx.lineTo(-8, 0);
    ctx.lineTo(-15, 14);

    ctx.closePath();

    ctx.fill();

    // Cabina

    ctx.fillStyle = "#ffffff";

    ctx.fillRect(
        -4,
        -6,
        10,
        12
    );

    // Motor

    ctx.fillStyle = "#ff8b57";

    ctx.fillRect(
        -20,
        -6,
        8,
        12
    );

    ctx.restore();
}

// ===============================
// DIBUJAR OBSTÁCULOS
// ===============================

function drawObstacles() {

    obstacles.forEach(obstacle => {

        ctx.save();

        ctx.translate(
            obstacle.x + obstacle.width / 2,
            obstacle.y + obstacle.height / 2
        );

        ctx.rotate(obstacle.rotation);

        if (obstacle.type === "fast") {

            ctx.fillStyle = "#ffffff";

        } else {

            ctx.fillStyle = "#ff7135";
        }

        ctx.fillRect(
            -obstacle.width / 2,
            -obstacle.height / 2,
            obstacle.width,
            obstacle.height
        );

        // Detalles pixelados

        ctx.fillStyle = "#071a33";

        ctx.fillRect(
            -5,
            -5,
            10,
            10
        );

        ctx.restore();
    });
}

// ===============================
// DIBUJAR BORDE
// ===============================

function drawBorder() {

    ctx.strokeStyle = "#ff7135";

    ctx.lineWidth = 3;

    ctx.strokeRect(
        2,
        2,
        WIDTH - 4,
        HEIGHT - 4
    );
}

// ===============================
// ACTUALIZAR PUNTOS
// ===============================

function updateScore() {

    if (frame % 8 === 0) {

        score++;

        scoreText.textContent = score;
    }

    // Cada 50 puntos sube el nivel

    const newLevel =
        Math.floor(score / 50) + 1;

    if (newLevel !== level) {

        level = newLevel;

        console.log(
            "Nivel:",
            level
        );
    }
}

// ===============================
// DIBUJAR INFORMACIÓN
// ===============================

function drawLevel() {

    ctx.fillStyle = "white";

    ctx.font = "bold 16px monospace";

    ctx.fillText(
        "LVL " + level,
        15,
        25
    );
}

// ===============================
// LOOP PRINCIPAL
// ===============================

function gameLoop() {

    if (!gameRunning) {
        return;
    }

    frame++;

    ctx.clearRect(
        0,
        0,
        WIDTH,
        HEIGHT
    );

    updateStars();

    updatePlayer();

    spawnObstacles();

    updateObstacles();

    updateScore();

    checkCollisions();

    drawStars();

    drawObstacles();

    drawPlayer();

    drawLevel();

    drawBorder();

    requestAnimationFrame(gameLoop);
}

// ===============================
// INICIAR
// ===============================

function startGame() {

    if (gameRunning) {
        return;
    }

    gameRunning = true;

    score = 0;
    level = 1;
    frame = 0;

    obstacles = [];

    player.x = 80;
    player.y = HEIGHT / 2;

    scoreText.textContent = "0";

    startScreen.classList.add("hidden");
    gameOverScreen.classList.add("hidden");

    gameLoop();
}

// ===============================
// GAME OVER
// ===============================

function gameOver() {

    gameRunning = false;

    finalScore.textContent = score;

    if (score > highScore) {

        highScore = score;

        localStorage.setItem(
            "techcodeHighScore",
            highScore
        );

        highScoreText.textContent =
            highScore;
    }

    gameOverScreen.classList.remove(
        "hidden"
    );
}

// ===============================
// BOTONES
// ===============================

startBtn.addEventListener(
    "click",
    startGame
);

restartBtn.addEventListener(
    "click",
    startGame
);