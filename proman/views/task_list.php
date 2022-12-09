<?php
require "common.php";
$title = 'Task list';

ob_start();
require 'nav.php';

if(isset($error_message))
{
    echo "<p class='message_error'>$error_message</p>";
}

if(isset($confirm_message))
{
    echo "<p class='message_ok'>$confirm_message</p>";
}
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
                   <?php echo " (Date: " . $task["ttime"] . ", Project: " . $task["project"] . ")"; ?>
                </a>

                <form method="post">
                    <input type="hidden" value="<?php echo $task['id'] ?>" name="delete">
                    <input type="submit" value="Delete">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>