<?php
    
    session_start();
    include("conn_db.php");
    
    
    $Title = $_POST["TitleNews"];
    $Desc = $_POST["DescNews"];
    $Body = $_POST["BodyNews"];

    if (strcmp($Title, "") == 0 || strcmp($Desc, "") == 0 || strcmp($Body, "") == 0) {
        header("Location: news_editor.php?id=".$_SESSION['NewsID']."&msg=nofields");
    }
    else {
        $query = "UPDATE websitenews SET title='$Title', newsHomeText='$Desc', newsFullText='$Body' WHERE NID='".$_SESSION["NewsID"]."'";     
        mysqli_query($CONN, $query) or print(mysqli_error($CONN));
        header("Location: news_editor.php?id=".$_SESSION['NewsID']."&msg=updated");
    }

?>