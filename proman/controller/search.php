<?php
require "../model/model.php";
require "common.php";

if(isset($_POST['submit']))
{
    
    $title = escape(trim($_POST['title']));
    $category = escape($_POST['category']);

    if(empty($title) && empty($category))
    {
        $error_message ="Title or category empty";
    }

    else
    {
        if(!(empty($title)))
        {
            $results = searchT($title);
        }
        
        
        if(!(empty($category)))
        {
            $results = searchC($category);
        } 

    }
}


require "../views/search.php";
?>