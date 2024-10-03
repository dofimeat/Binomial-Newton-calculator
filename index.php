<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binomial Newton</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Калькулятор Бином Ньютона</h1>
    <form method="post" action="index.php">
        <label for="a">Введите значение для a:</label>
        <input type="number" step="0.01" name="a" id="a" required>

        <label for="b">Введите значение для b:</label>
        <input type="number" step="0.01" name="b" id="b" required>

        <label for="n">Введите значение для n:</label>
        <input type="number" name="n" id="n" required min="0">

        <input type="submit" value="Рассчитать">
    </form>

    <?php include 'main.php'; ?>
</div>

</body>
</html>
