<?php
include 'db_config.php';
include 'header.php';

$task_id = $_GET['task_id'] ?? 0;

$task_sql = "SELECT * FROM tasks WHERE id = $task_id";
$task_result = mysqli_query($conn, $task_sql);
$task = mysqli_fetch_assoc($task_result);

if (!$task) {
    echo "<p>Task not found.</p>";
    include 'footer.php';
    exit();
}

$project_id = $task['project_id'];
$project_sql = "SELECT project_name FROM projects WHERE id = $project_id";
$project_result = mysqli_query($conn, $project_sql);
$project = mysqli_fetch_assoc($project_result);

?>

<h2>Edit Task: <?php echo $task['task_description']; ?></h2>
<p><a href="tasks.php?project_id=<?php echo $project_id; ?>">&lt; Back to <?php echo $project['project_name']; ?> Tasks</a></p>

<form action="actions.php" method="POST">
    <input type="hidden" name="action" value="update_task">
    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
    
    <label for="task_description">Task Description:</label>
    <textarea id="task_description" name="task_description" required><?php echo $task['task_description']; ?></textarea>
    
    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="To Do" <?php if ($task['status'] == 'To Do') echo 'selected'; ?>>To Do</option>
        <option value="In Progress" <?php if ($task['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
        <option value="Done" <?php if ($task['status'] == 'Done') echo 'selected'; ?>>Done</option>
    </select>
    
    <label for="due_date">Due Date:</label>
    <input type="date" id="due_date" name="due_date" value="<?php echo $task['due_date']; ?>" required>
    
    <input type="submit" value="Update Task">
</form>

<?php
mysqli_close($conn);
include 'footer.php';
?>

