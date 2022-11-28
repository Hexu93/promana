<?php
require_once "../model/model.php";
require "common.php";

$projects = get_all_projects();

if(isset($_POST['submit']))
{
    $title = escape(trim($_POST['title']));
    $date = escape($_POST['date']);
    $time = escape($_POST['time']);
    $project_id = escape($_POST['project_id']);

    if(empty($title) || empty($project_id))
    {
        $error_message ="Title or project empty";
    }
    else
    {
        if(titleExists("tasks", $title))
        {
            $error_message ="I'm sorry, but looks like \"" . $title . "\" already exists";
        }

        else
        {
        add_task($title, $date, $time, $project_id);
        header('Refresh:4; url=task_list.php' );
        $confirm_message ='Project added successfully! Moving to task list...';
        }
    }
    
}

require_once "../views/task.php";