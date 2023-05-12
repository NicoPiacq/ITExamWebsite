<html>
	<head>
		
	</head>
	<body>
		<?php

			error_reporting(E_ALL);
			include("conn_db.php");
			include("pages_settings.php");
			include("system/page_header.php");

			$UserName = $_SESSION["username"];
            $querynews = mysqli_query($CONN,"SELECT * FROM websitenews WHERE NID='".$_GET["id"]."'");
            $rownews = mysqli_fetch_assoc($querynews);
    
        $querynewslist = mysqli_query($CONN,"SELECT * FROM websitenews ORDER BY NID DESC");
        $querycommentlist = mysqli_query($CONN, "SELECT * FROM newscomments INNER JOIN websitenews ON newscomments.NID = websitenews.NID WHERE websitenews.NID='".$_GET["id"]."' ORDER BY newscomments.Published DESC");
        
        echo "<title>Notizia: ".$rownews["title"]."</title>";
        
        echo "<section><div class='body_show_all_news'><center><font><br><b>Ultime Notizie</b></font></center><nav><ul>";
        
        while($row = mysqli_fetch_array($querynewslist)) {
		  echo "<li><a class='news_page' href=news.php?id=".$row['NID'].">".$row['title']."</a></li>";
        }
        echo "</ul></nav></div></section>";
        
        
        echo "<section><br> <br>
                <center><font class='body_text_news'><div class='body_news_space'>
                <center><b><font class='font_hmpg'>".$rownews["title"]."</b></font></center>
                <center><i><font><hr width=640px>".$rownews["newsHomeText"]."</i><br><br></font>".$rownews["newsFullText"]."</center>
                <br> <br>
                Autore: <b>".$rownews["author"]."</b></div></font></section>
                
                <center>
                <form class='body_write_comment_space' method=post action='news.php?id=".$rownews["NID"]."'>
                    <textarea type=text class='CommentNewsBox' placeholder='Scrivi un commento...' name='CommentWriteBox'></textarea><br>
                    <input class='sendComment' name='sendCommentNews' type=submit value=\"Aggiungi commento\"> <br>";
                        
                while($commentrow = mysqli_fetch_array($querycommentlist)) {
                    $PostedOn = date("d/m/Y H:i:s",strtotime($commentrow["Published"]));
                    $OneCommentFound = true;
                    echo "<div class='body_comment_space'>
                            <font class='user_written'>L'utente <b>".$commentrow["Author"]."</b> ha scritto: <i>(".$PostedOn.")</i></font><br>
                            <font>".$commentrow["Comment"]."
                        </div></font>";
                }
                if ($OneCommentFound == false) {
                        echo "<font><div class='body_comment_space_first'>
                                <b>Commenta per primo!</b>
                                </div></font>";
                }
        echo "</form>
            </center>
                
                

                
                
                </nav>";
        
        if (isset($_POST["sendCommentNews"]) && strcmp($_POST["CommentWriteBox"], "") != 0) {
            mysqli_query($CONN,"INSERT INTO newscomments(Author, Comment, NID) SELECT '".$_SESSION["username"]."', '".$_POST["CommentWriteBox"]."', NID FROM websitenews WHERE NID = '".$rownews["NID"]."' LIMIT 1");
            header("Refresh:0");
        }
        ?>
        
        
    </body>
</html>