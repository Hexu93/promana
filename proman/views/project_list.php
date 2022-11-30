<?php
require "common.php";
$title = 'Projects list';

ob_start();
require 'nav.php';
require_once 
?>

<div class="container">
    <p><a href="../">Go Home</a></p>

    <h1><?php echo $title . " (" . $projectCount . ")" ?></h1>

    <!-- No data -->
    <?php if ($projectCount == 0)
    { ?>

    <div>
        <p>You have not added any projects </p>
        <p><a href='../contorllers/project.php'>Add a project</a></p>
    </div>
    <?php } ?>

    <ul>
        <?php foreach ($projects as $project) : ?>
            <li>
                <a href="--/controller/project.php?id=<?php echo $project['id']; ?>">
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