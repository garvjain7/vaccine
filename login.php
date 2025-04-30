<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from POST request safely
    $Email = $_POST['Email'] ?? '';
    $Password = $_POST['Password'] ?? '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT Password FROM registration WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Fetch the hashed password from DB
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($Password, $hashedPassword)) {
            // Redirect to home_index.html with login=success
            header("Location: home_index.html?login=success");
            exit();  // Ensures script ends after redirect
        } else {
            // Invalid password
            echo "Invalid password!";
        }
    } else {
        // User not found
        echo "You are not registered!";
    }

    $stmt->close();
    $conn->close();
}
?>
