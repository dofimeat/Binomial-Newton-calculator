<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binomial Newton</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: flex-start; 
            height: 100vh;
            margin: 0;
            padding: 50px 10px; 
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border: 1px solid #c8e6c9;
            border-radius: 5px;
            text-align: left;
            font-size: 18px;
            line-height: 1.6;
        }
        .result h2 {
            color: #2e7d32;
            text-align: center;
        }
        .steps {
            margin-top: 20px;
            background-color: #f1f8e9;
            padding: 15px;
            border: 1px solid #dcedc8;
            border-radius: 5px;
        }
        .steps p {
            margin: 10px 0;
        }
        @media (max-width: 600px) {
            body {
                align-items: flex-start; 
                padding-top: 50px; 
            }
            .container {
                margin-top: 100px;
            }
            h1 {
                font-size: 24px;
            }
            input[type="number"],
            input[type="submit"] {
                font-size: 14px;
            }
            .container {
                padding: 15px;
            }
        }
    </style>
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
