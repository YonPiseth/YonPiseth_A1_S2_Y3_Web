<?php
$dsn = "mysql:host=localhost;dbname=testdb;charset=utf8mb4";
$username = "root";
$password = "";

try {
    // Attempt to connect to the database
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Example query with an intentional error
    $sql = "SELECT * FROM non_existent_table"; // This table does not exist
    $stmt = $pdo->query($sql);

} catch (PDOException $e) {
    // Log the error to a file
    error_log("[" . date("Y-m-d H:i:s") . "] Database Error: " . $e->getMessage() . "\n", 3, "errors.log");

    // Display the actual error for debugging
    echo "Database Error: " . $e->getMessage();
}
?>
