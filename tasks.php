<?php
include 'db_config.php';
include 'header.php';

$project_id = $_GET['project_id'] ?? 0;

$project_sql = "SELECT * FROM projects WHERE id = $project_id";
$project_result = mysqli_query($conn, $project_sql);
$project = mysqli_fetch_assoc($project_result);

if (!$project) {
    echo "<p>Project not found.</p>";
    include 'footer.php';
    exit();
}

$tasks_sql = "SELECT * FROM tasks WHERE project_id = $project_id";
$tasks_result = mysqli_query($conn, $tasks_sql);
?>

<h2>Project: <?php echo $project['project_name']; ?></h2>
<p><strong>Start Date:</strong> <?php echo $project['start_date']; ?></p>
<p><strong>End Date:</strong> <?php echo $project['end_date']; ?></p>

<h3>Tasks</h3>

<table>
    <thead>
        <tr>
            <th>Description</th>
            <th>Status</th>
            <th>Due Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($tasks_result) > 0) {
            while($row = mysqli_fetch_assoc($tasks_result)) {
                echo "<tr>";
                echo "<td>" . $row['task_description'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['due_date'] . "</td>";
                echo "<td>";
                echo "<a href=\"edit_task.php?task_id=" . $row['id'] . "\" class=\"button\">Edit</a> ";
                echo "<a href=\"actions.php?action=delete_task&id=" . $row['id'] . "&project_id=" . $project_id . "\" class=\"button delete\" onclick=\"return confirm(\'Are you sure you want to delete this task?\');\">Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan=\"4\">No tasks found for this project</td></tr>";
        }
        ?>
    </tbody>
</table>

<h3>Add New Task</h3>
<form action="actions.php" method="POST">
    <input type="hidden" name="action" value="add_task">
    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
    <label for="task_description">Task Description:</label>
    <textarea id="task_description" name="task_description" required></textarea>
    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="To Do">To Do</option>
        <option value="In Progress">In Progress</option>
        <option value="Done">Done</option>
    </select>
    <label for="due_date">Due Date:</label>
    <input type="date" id="due_date" name="due_date" required>
    <input type="submit" value="Add Task">
</form>

<?php
mysqli_close($conn);
include 'footer.php';
?>

