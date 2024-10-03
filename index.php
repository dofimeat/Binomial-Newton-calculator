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
    <form method="post" action="">
        <label for="a">Введите значение для a:</label>
        <input type="number" step="0.01" name="a" id="a" required>

        <label for="b">Введите значение для b:</label>
        <input type="number" step="0.01" name="b" id="b" required>

        <label for="n">Введите значение для n:</label>
        <input type="number" name="n" id="n" required min="0">

        <input type="submit" value="Рассчитать">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = floatval($_POST['a']);
        $b = floatval($_POST['b']);
        $n = intval($_POST['n']);

        function factorial($number) {
            if ($number == 0) {
                return 1;
            }
            $factorial = 1;
            for ($i = 1; $i <= $number; $i++) {
                $factorial *= $i;
            }
            return $factorial;
        }

        function binomial_coefficient($n, $k) {
            return factorial($n) / (factorial($k) * factorial($n - $k));
        }

        function binomial_expansion($a, $b, $n) {
            $terms = [];
            $steps = [];
            for ($k = 0; $k <= $n; $k++) {
                $coeff = binomial_coefficient($n, $k);  
                $a_pow = pow($a, $n - $k);              
                $b_pow = pow($b, $k);                 
                $term_value = $coeff * $a_pow * $b_pow; 

                $step = "Шаг $k:<br>";
                $step .= "Коэффициент: C($n, $k) = $coeff<br>";
                $step .= "$a^" . ($n - $k) . " = $a_pow<br>";
                $step .= "$b^$k = $b_pow<br>";
                $step .= "Разложения: {$coeff} * ($a^" . ($n - $k) . ") * ($b^$k) = " . number_format($term_value, 2) . "<br>";

                $steps[] = $step;

                if ($k > 0) {
                    $terms[] = " + {$coeff} * ($a^" . ($n - $k) . ") * ($b^$k)";
                } else {
                    $terms[] = "{$coeff} * ($a^" . ($n - $k) . ") * ($b^$k)";
                }
            }
            return [$terms, $steps];
        }

        list($terms, $steps) = binomial_expansion($a, $b, $n);

        echo "<div class='result'>";
        echo "<h2>Результат:</h2>";
        echo "<p>" . implode("", $terms) . "</p>";
        echo "</div>";

        echo "<div class='steps'>";
        echo "<h2>Порядок вычислений:</h2>";
        foreach ($steps as $step) {
            echo "<p>{$step}</p>";
        }
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
