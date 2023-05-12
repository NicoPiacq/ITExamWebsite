<?php
    
    session_start();
    include("conn_db.php");

    $Title = $_POST["TitleNews"];
    $Desc = $_POST["DescNews"];
    $Body = $_POST["BodyNews"];
    $Author = $_SESSION["username"];

    echo $Body;
    
    if (strcmp($Title, "") == 0 || strcmp($Desc, "") == 0 || strcmp($Body, "") == 0) {
        header("Location: news_editor.php?id=".$_SESSION['NewsID']."&msg=nofields");
    }
    else {
        $query = "INSERT INTO websitenews (author,title,newsHomeText,newsFullText) VALUES ('".$Author."','".$Title."','".$Desc."','".$Body."')";    
        mysqli_query($CONN, $query) or print(mysqli_error($CONN));
        header("Location: news_list.php?&msg=published");
    }


?>