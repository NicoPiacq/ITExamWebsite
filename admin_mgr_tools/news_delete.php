<?php
	
	error_reporting(E_ALL);
	session_start();
	include("conn_db.php");
	include("../system/page_header.php");

    if (!isset($_SESSION["username"]) && strcmp($_SESSION["usertype"], "administrator") !== 0)
        header("Location: login.php");
   
    $querynews = mysqli_query($CONN,"SELECT * FROM websitenews WHERE NID='".$_GET["id"]."'");
	$rownews = mysqli_fetch_assoc($querynews);
    $_SESSION["DeleteID"] = $_GET["id"];
    
    echo "<title>Elimina la notizia: ".$rownews["title"]." (ID #".$_SESSION["DeleteID"].")</title>";
	
    echo "<center><div class='delete_news_space'> <font class='font_hmpg'>Vuoi eliminare la notizia <br><b> ".$rownews["title"]."?</b></font> <br> <br>
    		<form method=post action=\"news_delete.php?id=".$_SESSION["DeleteID"]."\">
            <input class='unban' type=reset value=\"Annulla\" onclick=\"window.location.href='news_list.php'\">
            <input class=ban type=submit name=\"DeleteNews\" value=\"Cancella la notizia\" onclick=\"window.location.href='news_delete.php?id=".$_SESSION["DeleteID"]."\">
            <br></form></div>";
	
    if(isset($_POST["DeleteNews"]) && $_GET["id"] == $_SESSION["DeleteID"]) {
    	mysqli_query($CONN,"DELETE FROM websitenews WHERE NID='".$_SESSION["DeleteID"]."'") OR printf(mysqli_error($CONN));
        header("Location: $MainURL/admin_mgr_tools/news_list.php?msg=deleted");
    }

?>