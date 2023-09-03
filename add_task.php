<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST["task_description"];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "todolist");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert task into database
    $sql = "INSERT INTO tasks (task_description) VALUES ('$description')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: index.php"); // Redirect to index.php
        exit; // Make sure to exit after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
