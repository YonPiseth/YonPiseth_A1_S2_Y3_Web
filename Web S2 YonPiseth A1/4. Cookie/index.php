<?php
// Start session and check for a saved theme in the cookie
$theme = isset($_COOKIE["theme"]) ? $_COOKIE["theme"] : "light";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Selector</title>
    <style>
        body {
            background-color: <?php echo $theme === "dark" ? "#222" : "#fff"; ?>;
            color: <?php echo $theme === "dark" ? "#fff" : "#000"; ?>;
            font-family: Arial--  , sans-serif;
            text-align: center;
            padding: 50px;
        }
        .button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .light { background: #f0f0f0; color: #000; }
        .dark { background: #444; color: #fff; }
    </style>
</head>
<body>

<h2>Choose Theme</h2>

<!-- Theme Selection Buttons -->
<button class="button light" onclick="setTheme('light')">Light Mode</button>
<button class="button dark" onclick="setTheme('dark')">Dark Mode</button>

<script>
// Function to set theme using an AJAX request
function setTheme(theme) {
    document.cookie = "theme=" + theme + "; path=/";
    location.reload();
}
</script>

</body>
</html>
