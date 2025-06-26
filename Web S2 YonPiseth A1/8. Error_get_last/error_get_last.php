<?php
// Register shutdown function to catch fatal errors
register_shutdown_function("handleFatalError");

function handleFatalError() {
    $error = error_get_last(); // Get last error

    if ($error !== null) { // Check if an error exists
        echo "<div style='border:1px solid red; padding:10px; background:#fee; color:#900;'>";
        echo "<h3>Fatal Error Detected:</h3>";
        echo "<strong>Message:</strong> " . $error['message'] . "<br>";
        echo "<strong>File:</strong> " . $error['file'] . "<br>";
        echo "<strong>Line:</strong> " . $error['line'] . "<br>";
        echo "</div>";
    }
}

// Intentionally trigger an error
//nonExistentFunction(); // This function does not exist
?>
       