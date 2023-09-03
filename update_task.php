<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST["task_id"];
    $description = $_POST["task_description"];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "todolist");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE tasks SET task_description = '$description' WHERE task_id = $task_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
