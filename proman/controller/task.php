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
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
    
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }

    else 
    {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) 
    {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) 
    {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) 
    {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 

    else 
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        }

        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}





require "../views/task.php";