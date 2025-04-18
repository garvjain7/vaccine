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
            echo "Login successful!";
            // Redirect or start session here if needed
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "You are not registered!";
    }

    $stmt->close();
    $conn->close();
}
?>