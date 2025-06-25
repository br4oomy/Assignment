<?php
include 'db_config.php';
include 'header.php';

$sql = "SELECT * FROM projects";
$result = mysqli_query($conn, $sql);
?>

<h2>Projects</h2>

<table>
    <thead>
        <tr>
            <th>Project Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['project_name'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "<td>";
                echo "<a href=\"tasks.php?project_id=" . $row['id'] . "\" class=\"button\">View/Edit</a> ";
                echo "<a href=\"actions.php?action=delete_project&id=" . $row['id'] . "\" class=\"button delete\" onclick=\"return confirm('Are you sure you want to delete this project and all its tasks?');\">Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan=\"4\">No projects found</td></tr>";
        }
        ?>
    </tbody>
</table>

<h3>Add New Project</h3>
<form action="actions.php" method="POST">
    <input type="hidden" name="action" value="add_project">
    <label for="project_name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" required>
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>
    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>
    <input type="submit" value="Add Project">
</form>

<?php
mysqli_close($conn);
include 'footer.php';
?>

