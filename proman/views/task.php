<?php
if (!empty($_GET['id']))
{
    $title = 'Update task';
}
else
{
    $title = 'Add task';
}



ob_start();
require "nav.php";

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
        <input type="text" placeholder="New task" name="title" id="title" 
        value ="<?php echo $task_title; ?>" required>

        <label for="project">
            <span>Project of the task:</span>
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
        <input type="date" name="date" id="date" value="<?php echo $tDate; ?>" required>

        <label for="time">
            <span> Time estimated for task: </span>
        </label>
        <input type="number" placeholder="0" name="time" id="time" value="<?php echo $tTime; ?>" required>
        
        <label for="submit">
            <span></span>
        </label>
        <?php if(!empty($taskID))
        { ?>
            <input type="hidden" name="id" value="<?php echo $taskID ?>"/>
        <?php } ?>
                
        <input type="submit" name="submit" value="<?php echo (isset($taskID) and (!empty($taskID))) ? "Update" : "Add"; ?>">
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';


?>