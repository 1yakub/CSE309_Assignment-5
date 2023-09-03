<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $task_id = $_GET["id"];

    // Create connection
    $conn = new mysqli("localhost", "root", "", "todolist");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT task_description FROM tasks WHERE task_id = $task_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $description = $row["task_description"];
    } else {
        header("Location: index.html");
    }

    $conn->close();
} else {
    header("Location: index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-3"> 
                <h1 class="text-center mb-4">Edit Task</h1>
                <form action="update_task.php" method="post">
                    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                    <input type="text" name="task_description" class="form-control mb-3" value="<?php echo $description; ?>" required>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning"> 
                            Update Task
                        </button>
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
