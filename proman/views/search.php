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
            
    <form method="post">
    
        <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" placeholder="Title" name="title" id="title" required>
    
        <input type="submit" name="submit" value=" Find " />
 
    </form>
    
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>