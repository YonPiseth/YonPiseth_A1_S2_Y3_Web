<?php
$input = $_POST['data'] ?? "Hello, World!"; // Default input if none is provided
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Debugging Demo</title>
</head>
<body>

    <h2>Enter Any Data:</h2>
    <form method="post">
        <input type="text" name="data" value="<?php echo htmlspecialchars($input); ?>">
        <button type="submit">Show Output</button>
    </form>

    <h3>var_dump() Output:</h3>
    <pre><?php var_dump($input); ?></pre>

    <h3>print_r() Output:</h3>
    <pre><?php print_r($input); ?></pre>

</body>
</html>
