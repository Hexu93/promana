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
        
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>