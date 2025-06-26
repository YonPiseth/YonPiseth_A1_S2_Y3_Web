<?php 
header("Content-Type: application/json");

// Database connection
$servername = "localhost";
$username = "root";  // Default for WAMP
$password = "";      
$dbname = "rest_api";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    respondWithError("Connection failed: " . $conn->connect_error, 500);
}

// Get request method and endpoint
$method = $_SERVER['REQUEST_METHOD'];

// Extract the path to identify the endpoint
$path = explode("/", trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/"));
$endpoint = null;

// After 'content/API/Rest_API.php', the endpoint starts from the next segment
if (count($path) > 3) {
    $endpoint = $path[3]; // This should be 'items' or 'item/{id}'
} else {
    respondWithError("Invalid endpoint", 400);
}

// Route the request based on the method
switch ($method) {
    case 'GET':
        handleGetRequest($path, $conn);
        break;

    case 'POST':
        handlePostRequest($endpoint, $conn);
        break;

    case 'PUT':
        handlePutRequest($endpoint, $conn);
        break;

    case 'DELETE':
        handleDeleteRequest($endpoint, $conn);
        break;

    default:
        respondWithError("Method not allowed", 405);
}

// Close database connection
$conn->close();

/**
 * Handle GET requests
 */
function handleGetRequest($path, $conn) {
    if ($path[3] === 'items') {
        fetchAllItems($conn);
    } elseif ($path[3] === 'item' && isset($path[4])) {
        fetchItemById($conn, (int)$path[4]);
    } else {
        respondWithError("Invalid endpoint", 400);
    }
}

/**
 * Handle POST requests
 */
function handlePostRequest($endpoint, $conn) {
    if ($endpoint === 'item') {
        createItem($conn);
    } else {
        respondWithError("Invalid endpoint", 400);
    }
}

/**
 * Handle PUT requests
 */
function handlePutRequest($endpoint, $conn) {
    if ($endpoint === 'item') {
        updateItem($conn);
    } else {
        respondWithError("Invalid endpoint", 400);
    }
}

/**
 * Handle DELETE requests
 */
function handleDeleteRequest($endpoint, $conn) {
    if ($endpoint === 'item') {
        deleteItem($conn);
    } else {
        respondWithError("Invalid endpoint", 400);
    }
}

/**
 * Fetch all items from the database
 */
function fetchAllItems($conn) {
    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        respondWithSuccess($items);
    } else {
        respondWithMessage("No items found");
    }
}

/**
 * Fetch a single item by ID
 */
function fetchItemById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        respondWithSuccess($result->fetch_assoc());
    } else {
        respondWithError("Item not found", 404);
    }

    $stmt->close();
}

/**
 * Create a new item
 */
function createItem($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data["name"]) || empty($data["description"])) {
        respondWithError("Missing required fields", 400);
    }

    $name = $conn->real_escape_string($data["name"]);
    $description = $conn->real_escape_string($data["description"]);

    $stmt = $conn->prepare("INSERT INTO items (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        respondWithSuccess(["message" => "Item created successfully"], 201);
    } else {
        respondWithError("Error creating item: " . $conn->error, 500);
    }

    $stmt->close();
}

/**
 * Update an existing item
 */
function updateItem($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data["id"]) || empty($data["name"]) || empty($data["description"])) {
        respondWithError("Missing required fields", 400);
    }

    $id = (int)$data["id"];
    $name = $conn->real_escape_string($data["name"]);
    $description = $conn->real_escape_string($data["description"]);

    // Check if item exists
    $stmt = $conn->prepare("SELECT id FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        respondWithError("Item not found", 404);
    }
    $stmt->close();

    // Update item
    $stmt = $conn->prepare("UPDATE items SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $id);

    if ($stmt->execute()) {
        respondWithSuccess(["message" => "Item updated successfully"]);
    } else {
        respondWithError("Error updating item: " . $conn->error, 500);
    }

    $stmt->close();
}

/**
 * Delete an item
 */
function deleteItem($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data["id"])) {
        respondWithError("Missing item ID", 400);
    }

    $id = (int)$data["id"];

    // Check if item exists
    $stmt = $conn->prepare("SELECT id FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        respondWithError("Item not found", 404);
    }
    $stmt->close();

    // Delete item
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        respondWithSuccess(["message" => "Item deleted successfully"]);
    } else {
        respondWithError("Error deleting item: " . $conn->error, 500);
    }

    $stmt->close();
}

/**
 * Respond with a success message
 */
function respondWithSuccess($data = [], $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode([
        "status" => "success",
        "data" => $data
    ]);
    exit();
}

/**
 * Respond with an error message
 */
function respondWithError($message, $statusCode = 400) {
    http_response_code($statusCode);
    echo json_encode([
        "status" => "error",
        "message" => $message
    ]);
    exit();
}

/**
 * Respond with a simple message
 */
function respondWithMessage($message) {
    echo json_encode(["message" => $message]);
    exit();
}
?>
