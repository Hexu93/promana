<?php
require_once "../model/model.php";

$projects = get_all_tasks();
$projectCount = get_all_tasks_count();

require "../views/project_list.php";
?>