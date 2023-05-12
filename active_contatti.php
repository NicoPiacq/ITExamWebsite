<html>
	<head>
	<?php
		include("system/page_header.html");
        include("mtn_settings.php");
	?>
		<meta charset="utf-8">
		<title>Pagina di accesso</title>
		<meta name="autore" content="Nicola Piacquaddio">
		<meta name="description" content="Esame di Nicola Piacquaddio">
	</head>
	<body>
	<br>
	<center>
            <br> <font>&Egrave; possibile contattare l'amministratore di questo sito con l'email! <br></font> <br>
                <form class="contactMeForm" action="contatti.php" method="post">
                    <font>La tua email:</font> <br>
                    <input type=text class="contactBox" placeholder="Email" name=UserEmail> <br>
                    <font>Oggetto del messaggio:</font> <br>
                    <input type=text class="contactBoxSub" placeholder="Contatto dal sito web" name=Subject> <br>
                    <font>Messaggio:</font> <br>
                    <textarea class="contactBoxBody" name=Body rows="1" cols="50" wrap="physical" id="contactBoxBody"></textarea> <br>
                </form>
				<br> <font><a class=contactMe href="mailto:nicola.piacquaddio@gmail.com?subject=Contatto%20dal%20Sito%20Web&body=Ciao%20sono%20qui%20per%20contattarti%20per%20il%20sito."></a></font> <br> <br>
	</center>
        
        <?php 
            
            $msg_header = "From: ".$_POST["UserEmail"]."";
            mail("nicola.piacq99@gmail.com", $_POST["Subject"], $_POST["Body"], $msg_header);
        
        ?>
        
	</body>
	<footer>
	<?php include("system/page_bottom.html"); ?>
	</footer>
</html>
