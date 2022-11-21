<?php
$title = 'Add a task to a project';

require_once "../controller/task.php";
ob_start();
require_once "nav.php";


?>

<div class="container">
    <h1><?php echo $title ?></h1>

    <?php
    if (isset($error_message))
    {
        echo "<p class='message_error'>$error_message</p>";
    }

    if (isset($confirm_message))
    {
        echo "<p class='message_ok'>$confirm_message</p>";
    }
    ?>

    <form method="post">
        <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" placeholder="New task" name="title" id="title" required>
        <label for="project">
            <span>Project of the task:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <select name="project" id="project" required>
            <option value="">Select the project the task is linked to:</option>
            <?php foreach ($projects as $project) { ?>

            <option value= "<?php $project['id']  ?>" >
                <?php echo $project['title']; ?>
            </option>
            <?php } ?>
            <?php //endforeach; ?>
        </select>
        <input type="submit" name="submit" value="Add">
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';


?>