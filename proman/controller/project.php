<?php
require_once "../model/model.php";
require "common.php";

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
        add_project($title, $category);
        header('Refresh:4; url=project_list.php' );
        $confirm_message ='Project added successfully! Moving to project list...';
    }
}

require "../views/project.php";