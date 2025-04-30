<?php
    // Get values from POST request
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Age = $_POST['Age'];
    $District = $_POST['District'];
    $State = $_POST['State'];

    // Hash the password before storing
    $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO registration(Name, Email, Password, Age, District, State) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $Name, $Email, $HashedPassword, $Age, $District, $State);
        $stmt->execute();
        // echo "Registration is successful...";
        $stmt->close();
        $conn->close();
    }
?>
