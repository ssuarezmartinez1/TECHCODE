<?php
$columnas = $planes ? array_keys($planes[0]) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes | Rocopolis DC</title>
    <link rel="stylesheet" href="../planes.css">
</head>
<body>
    <main>
        <h1>Planes disponibles</h1>
        <?php if ($error): ?>
            <p><?= htmlspecialchars($error) ?></p>
            <p>Crea la tabla <strong>planes</strong> en la base de datos <strong>rocopolisdc</strong> desde phpMyAdmin.</p>
        <?php elseif (!$planes): ?>
            <p>No hay planes registrados en MySQL.</p>
        <?php else: ?>
            <?php foreach ($planes as $plan): ?>
                <article>
                    <?php foreach ($columnas as $columna): ?>
                        <p>
                            <strong><?= htmlspecialchars($columna) ?>:</strong>
                            <?= htmlspecialchars(is_array($plan[$columna]) ? implode(', ', $plan[$columna]) : (string) $plan[$columna]) ?>
                        </p>
                    <?php endforeach; ?>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
        <a href="../index.php">Volver al inicio</a>
    </main>
</body>
</html>
