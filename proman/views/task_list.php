<?php
$title = 'Task list';

ob_start();
require 'nav.php';
?>

<div class="container">
    <p><a href="../">Go Home</a></p>

    <h1><?php echo $title . " (" . $tasksCount . ")" ?></h1>

    <!-- No data -->
    <?php if ($tasksCount == 0)
    { ?>

    <div>
        <p>You have not added any tasks </p>
        <p><a href='../contorllers/task.php'>Add a task</a></p>
    </div>
    <?php } ?>

    <ul>
        <?php foreach ($tasks as $task) : ?>
            <li>
                <?php echo $tasks["title"]; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>