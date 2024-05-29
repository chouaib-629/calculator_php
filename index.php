<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_1.css">

    <title>Calculator</title>
</head>

<body>

    <!-- Add a background for the operator selection -->
    <div class="operator-background"></div>

    <!-- Display the title of the calculator -->
    <h1>Simple Calculator</h1>

    <?php 
        // Initialize variables to store the numbers and operator
        // $num1;
        // $num2;
        // $operator = '+';
        // $result = '';

        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Get the input values from the form
            $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST['operator']);
            
            // Initialize a flag to track errors
            $errors = false;

            // Check for empty fields
            if (empty($num1) || empty($num2) || empty($operator)) {
                echo "<p class='calculate_error'>Fill in all fields!</p>";
                $errors = true;
            }

            // Check if the input values are numeric
            if (!is_numeric($num1) ||!is_numeric($num2)) {
                echo "<p class='calculate_error'>Only numbers are allowed!</p>";
                $errors = true;
            }

            // Check for division by zero
            if ($operator == "/" && $num2 == 0) {
                echo "<p class='calculate_error'>Cannot divide by zero!</p>";
                $errors = true;
            }
    

            // Perform the calculation if no errors
            if (!$errors) {
                // Use a match statement to perform the calculation based on the operator
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

    <!-- Create a form to input numbers and select an operator -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

        <!-- Input field for the first number -->
        <input type="number" name="num1" placeholder="Enter first number" value="<?php echo $num1;?>" required>

        <!-- Select field for the operator -->
        <select name="operator">
            <!-- Options for the operator -->
            <option value="+" <?php echo $operator == '+'? 'selected' : '';?>>Addition ( + )</option>
            <option value="-" <?php echo $operator == '-'? 'selected' : '';?>>Soutraction ( - )</option>
            <option value="*" <?php echo $operator == '*'? 'selected' : '';?>>Multiplication ( * )</option>
            <option value="/" <?php echo $operator == '/'? 'selected' : '';?>>Division ( / )</option>
        </select>

        <!-- Input field for the second number -->
        <input type="number" name="num2" placeholder="Enter second number" value="<?php echo $num2;?>" required>

        <!-- Submit button to calculate the result -->
        <button>
            Calculate
        </button>
    </form>

    <?php 
        // Display the result if it's set
        if (isset($result)) {
            echo "<p class='print_result'>Result = $result</p>";
        }
   ?>

    <!-- Include the script file -->
    <script src="js/script.js"></script>

</body>
</html>