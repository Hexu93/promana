<?php
require "common.php";
$title = 'Task list';

ob_start();
require 'nav.php';
?>

<div class="container">
    <p><a href="../">Go Home</a></p>

    <h1><?php echo $title . " (" . $taskCount . ")" ?></h1>

    <!-- No data -->
    <?php if ($taskCount == 0)
    { ?>

    <div>
        <p>You have not added any tasks </p>
        <p><a href='../contorllers/task.php'>Add a task</a></p>
    </div>
    <?php } ?>

    <ul>
        <?php foreach ($tasks as $task) : ?>
            <li>
                <a href="../controller/task.php?id=<?php echo $task['id']; ?>">
                   <?php echo escape($task["title"]) ?>
                </a>
                <?php echo " (Date: " . $task["ttime"] . ", Project: " . $task["project"] . ")"; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>