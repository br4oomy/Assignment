<?php
include 'db_config.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'add_project':
            $project_name = $_POST['project_name'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $sql = "INSERT INTO projects (project_name, start_date, end_date) VALUES ('$project_name', '$start_date', '$end_date')";
            if (mysqli_query($conn, $sql)) {
                header('Location: projects.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'add_task':
            $project_id = $_POST['project_id'];
            $task_description = $_POST['task_description'];
            $status = $_POST['status'];
            $due_date = $_POST['due_date'];
            $sql = "INSERT INTO tasks (project_id, task_description, status, due_date) VALUES ('$project_id', '$task_description', '$status', '$due_date')";
            if (mysqli_query($conn, $sql)) {
                header('Location: tasks.php?project_id=' . $project_id);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'update_task':
            $task_id = $_POST['task_id'];
            $project_id = $_POST['project_id'];
            $task_description = $_POST['task_description'];
            $status = $_POST['status'];
            $due_date = $_POST['due_date'];
            $sql = "UPDATE tasks SET task_description = '$task_description', status = '$status', due_date = '$due_date' WHERE id = $task_id";
            if (mysqli_query($conn, $sql)) {
                header('Location: tasks.php?project_id=' . $project_id);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
    }
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'delete_project':
            $id = $_GET['id'];
            $sql = "DELETE FROM projects WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                header('Location: projects.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'delete_task':
            $id = $_GET['id'];
            $project_id = $_GET['project_id'];
            $sql = "DELETE FROM tasks WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                header('Location: tasks.php?project_id=' . $project_id);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
    }
}

mysqli_close($conn);
?>

