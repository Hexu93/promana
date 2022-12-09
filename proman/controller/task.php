<?php
require_once "../model/model.php";
require "common.php";

$projects = get_all_projects();
$task_title = '';
$date = '';
$time = '';
$project_id = '';

if(isset($_POST['submit']))
{
    $taskID = null;
    if(isset($_POST['id']))
    {
        $taskID = $_POST['id'];
    }

    $title = escape(trim($_POST['title']));
    $date = escape($_POST['date']);
    $time = escape($_POST['time']);
    $project_id = escape($_POST['project_id']);

    if(empty($title) || empty($project_id) || empty($date) || empty($time))
    {
        $error_message ="Please fill all fields";
    }
    else
    {
        if(titleExists("tasks", $title) && $taskID == null)
        {
            $error_message ="I'm sorry, but looks like \"" . $title . "\" already exists";
        }
        else
        {
            if(add_task($title, $date, $time, $project_id, $taskID))
            {
                header('Refresh:4; url=task_list.php' );
                if(!empty($taskID))
                {
                    $confirm_message = escape($title) . ' updated successfully! Moving to task list...';
                }
                else
                {
                    $confirm_message = escape($title) . ' added successfully! Moving to task list...';
                }
            }
            else
            {
                $error_message = "There's something wrong";
            }
        }
    }    
}

require "../views/task.php";