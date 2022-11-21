<?php
require_once "../model/model.php";
require "common.php";

$projects = get_all_projects();

if(isset($_POST['submit']))
{
    $title = escape(trim($_POST['title']));
    $category = escape($_POST['category']);

    if(empty($title) || empty($category))
    {
        $error_message ="Title or category empty";
    }
    else
    {
        if(titleExists("task", $title))
        {
            $error_message ="I'm sorry, but looks like \"" . $title . "\" already exists";
        }

        else
        {
        add_project($title, $category);
        header('Refresh:4; url=project_list.php' );
        $confirm_message ='Project added successfully! Moving to project list...';
        }
    }
    
}

require "../views/task.php";