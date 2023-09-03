<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $task_id = $_GET["id"];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "todolist");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM tasks WHERE task_id = $task_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: index.php");
}
?>