<?php
$title = 'Add a task to a project';

require_once "../controller/task.php";

require_once "nav.php";
//require_once "../controller/task.php";
ob_start();


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
        <select name="project_id" id="project_id" required>
            <option value="">Select the project the task is linked to:</option>
            <?php foreach ($projects as $project) { ?>

            <option value= "<?php echo $project['id']  ?>" 
            <?php if ($project === $project['id']) {echo 'selected';} ?> >
                <?php echo $project['title']; ?>
            </option>
            <?php } ?>
            <?php //end foreach; ?>
        </select>

        <label for="date">
            <span> Date:</span>
        </label>
        <input type="date" name="date" id="date" required>

        <label for="time">
            <span> Time estimated for task: </span>
        </label>
        <input type="number" placeholder="0" name="time" id="time"  required>

        <label for="submit">
            <span></span>
        </label>
        <input type="submit" name="submit" value="Add">
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';


?>