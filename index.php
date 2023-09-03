<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TODO List</title>
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
                    <h1 class="text-center mb-5">TODO List</h1>
                    <form action="add_task.php" method="post">
                        <input
                            type="text"
                            name="task_description"
                            class="form-control mb-2"
                            placeholder="Enter task description"
                            required
                        />
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </form>
                    <ul class="list-group mt-3">
                        <?php
                            // Fetch tasks from database
                            $conn = new mysqli("localhost", "root", "", "todolist");

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT task_id, task_description FROM tasks";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo '<table class="table table-bordered">';
                                echo '<thead class="thead-dark">';
                                echo '<tr>';
                                echo '<th scope="col" class="text-left">Tasks</th>';
                                echo '<th scope="col" class="text-right">Actions</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                            
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row["task_description"] . '</td>';
                                    echo '<td class="text-right">';
                                    echo '<a href="edit_task.php?id=' . $row["task_id"] . '" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Edit</a>';
                                    echo '<a href="delete_task.php?id=' . $row["task_id"] . '" class="btn btn-danger ml-2"><i class="fas fa-trash-alt"></i> Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            
                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo '<p>No tasks found.</p>';
                            }

                            $conn->close();
                        ?>
                    </ul>
                        </div>
                    </div>
        </div>
    </body>
</html>
