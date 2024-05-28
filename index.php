<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_1.css">
    <title>Calculator</title>
</head>

<body>

    <div class="operator-background"></div>

    <h1>Simple Calculator</h1>

    <?php 
        $num1;
        $num2;
        $operator = '+';
        $result = '';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // getting the data
            $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST['operator']);
            
            // error handlers
            $errors = false;
            if (empty($num1) || empty($num2) || empty($operator)) {
                echo "<p class='calculate_error'>Fill in all fields!</p>";
                $errors = true;
            }

            if (!is_numeric($num1) ||!is_numeric($num2)) {
                echo "<p class='calculate_error'>Only numbers are allowed!</p>";
                $errors = true;
            }

            if ($operator == "/" && $num2 == 0) {
                echo "<p class='calculate_error'>Cannot divide by zero!</p>";
                $errors = true;
            }
    

            // calculation
            if (!$errors) {
                $result = match ($operator) {
                    "+" => $num1 + $num2,
                    "-" => $num1 - $num2,
                    "*" => $num1 * $num2,
                    "/" => $num1 / $num2,
                    default => "<p class='calculate_error'>Calculation error!!!</p>",
                };
            }
        }
   ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

        <input type="number" name="num1" placeholder="Enter first number" value="<?php echo $num1;?>" required>
        <select name="operator">
            <option value="+" <?php echo $operator == '+'? 'selected' : '';?>>Addition ( + )</option>
            <option value="-" <?php echo $operator == '-'? 'selected' : '';?>>Soutraction ( - )</option>
            <option value="*" <?php echo $operator == '*'? 'selected' : '';?>>Multiplication ( * )</option>
            <option value="/" <?php echo $operator == '/'? 'selected' : '';?>>Division ( / )</option>
        </select>
        <input type="number" name="num2" placeholder="Enter second number" value="<?php echo $num2;?>" required>

        <button>
            Calculate
        </button>
    </form>

    <?php 
        if (isset($result)) {
            echo "<p class='print_result'>Result = $result</p>";
        }
   ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const operators = ['+', '-', '*', '/'];
            const operatorBackground = document.querySelector('.operator-background');
            const numberOfSigns = 100; // Adjust the number of signs as needed

            for (let i = 0; i < numberOfSigns; i++) {
                const sign = document.createElement('div');
                sign.classList.add('operator-sign');
                sign.textContent = operators[Math.floor(Math.random() * operators.length)];
                sign.style.top = `${Math.random() * 100}vh`;
                sign.style.left = `${Math.random() * 100}vw`;
                sign.style.fontSize = `${Math.random() * 40 + 10}px`; // Random font size between 10px and 30px
                sign.style.transform = `rotate(${Math.random() * 360}deg)`; // Random rotation

                operatorBackground.appendChild(sign);
            }
        });
    </script>


</body>

</html>