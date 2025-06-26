<?php
$servername = "localhost";
$username = "seth";
$password = "123";
$dbname = "MAE";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create user table if not exists
$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user'])) {
        $delete_id = $_POST['delete_user'];
        $delete_sql = "DELETE FROM user WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $user = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (!empty($user) && !empty($email) && !empty($password) && !empty($confirm_password)) {
            if ($password === $confirm_password) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $user, $email, $hashed_password);
                
                if ($stmt->execute()) {
                    echo "User registered successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }
                
                $stmt->close();
            } else {
                echo "Passwords do not match.";
            }
        } else {
            echo "All fields are required.";
        }
    }
}



// Fetch all users
$result = $conn->query("SELECT id, username, email, password FROM user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>
        
        <button type="submit">Register</button>
    </form>
    
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Delete</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['username']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['password']); 'No Password'; ?></td>
        <td>
            <form method="post" action="" style="display:inline;">
                <input type="hidden" name="delete_user" value="<?php echo $row['id']; ?>">
                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
            </form>
        </td>
    </tr>
<?php } ?>


    </table>
</body>
</html>

<?php
$conn->close();
?>
