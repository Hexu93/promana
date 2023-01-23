<?php

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
            
    <form method="post">
    
        <label for="title">
            <span>Title:</span>            
        </label>
        <input type="text" placeholder="Title" name="title" id="title">
        <label for="category">
            <span>Category:</span>            
        </label>
        <input type="text" placeholder="Category" name="category" id="category">
    
        <input type="submit" name="submit" value=" Find " >
 
    </form>
    <ul>
        <?php foreach ($results as $project) : ?>
            <li>
                <a href="../controller/project.php?id=<?php echo $project['id']; ?>">
                <?php echo escape($project["title"]) ?>
                </a>

                
               
            </li>
        <?php endforeach; ?>        
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>