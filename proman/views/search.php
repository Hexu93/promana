<?php
require "common.php";
$title = 'Search projects';

ob_start();
require "nav.php";
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

    <h1><?php echo $title ?></h1>
    <ul>
        <?php foreach ($projects as $project) : ?>
            <li>
                <a href="../controller/project.php?id=<?php echo $project['id']; ?>">
                <?php echo escape($project["title"]) ?>
                </a>

                <form method="post">
                    <input type="hidden" value="<?php echo $project['id'] ?>" name="delete">
                    <input type="submit" value="Delete">
                </form>

               
            </li>
        <?php endforeach; ?>

        <form method="post">
            <input type="submit" value="Print to file" name="print">
        </form>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>