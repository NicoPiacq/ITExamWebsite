<html>
<link rel="stylesheet" href="../styles/style.css">	

<header>
	<a href="#" class="logo"><img src="../images/logo.png"></a>
	<nav>
		<ul>
            <?php
                session_start();                
                include("conn_db.php");

                $url = $_SERVER["REQUEST_URI"];
                $switch_url = explode("?", $url);
            
                switch($switch_url[0]) {
                    case "/index.php":
                    case "/": {
                        echo "<ul>
			                     <li><a class='active' href='index.php'>Home</a></li>
			                     <li><a href='info.php'>Informazioni</a></li>
			                     <li><a href='contatti.php'>Contatti</a></li>
		                      </ul>";
                        break;
                    }
                    case "/me.php": {
                         echo "<ul>
			                     <li><a class='active' href='me.php'>Home</a></li>
			                     <li><a href='info.php'>Informazioni</a></li>
			                     <li><a href='contatti.php'>Contatti</a></li>
                                 <li><a class='logout' href='logout.php'>Logout</a></li>
		                      </ul>";
                        break;                       
                    }
                    case "/news.php": {
                         echo "<ul>
			                     <li><a href='me.php'>Home</a></li>
			                     <li><a href='info.php'>Informazioni</a></li>
			                     <li><a href='contatti.php'>Contatti</a></li>
                                 <li><a class='logout' href='logout.php'>Logout</a></li>
		                      </ul>";
                        break;                       
                    }
                    case "/register.php": {
                         echo "<ul>
			                     <li><a href='index.php'>Home</a></li>
			                     <li><a href='info.php'>Informazioni</a></li>
			                     <li><a href='contatti.php'>Contatti</a></li>
		                      </ul>";
                        break;                       
                    }
                    case "/info.php": {
                         if (isset($_SESSION["username"])) {
                            echo "<ul>
			                         <li><a href='me.php'>Home</a></li>
			                         <li><a class='active' href='info.php'>Informazioni</a></li>
			                         <li><a href='contatti.php'>Contatti</a></li>
                                    <li><a class='logout' href='logout.php'>Logout</a></li>
		                          </ul>";
                         }
                        else {
                            echo "<ul>
			                         <li><a href='index.php'>Home</a></li>
			                         <li><a class='active' href='info.php'>Informazioni</a></li>
			                         <li><a href='contatti.php'>Contatti</a></li>
		                          </ul>";
                        }
                        break;                       
                    }
                    case "/contatti.php": {
                         if (isset($_SESSION["username"])) {
                            echo "<ul>
			                         <li><a href='me.php'>Home</a></li>
			                         <li><a href='info.php'>Informazioni</a></li>
			                         <li><a class='active' href='contatti.php'>Contatti</a></li>
                                    <li><a class='logout' href='logout.php'>Logout</a></li>
		                          </ul>";
                         }
                        else {
                            echo "<ul>
			                         <li><a href='index.php'>Home</a></li>
			                         <li><a href='info.php'>Informazioni</a></li>
			                         <li><a class='active' href='contatti.php'>Contatti</a></li>
		                          </ul>";
                        }
                        break;                       
                    }
                    case "/maitenance.php": {
                         echo "<ul>
			                     <li><a href='maitenance.php'>Aggiorna</a></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/admin_manager.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a class='active' href='admin_manager.php'>User Editor</a></li>
                                 <li><a href='editor_maitenance.php'>Manutenzione Sito</a></li>
                                 <li><a href='news_list.php'>Gestione Notizie</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/editor_maitenance.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='admin_manager.php'>User Editor</a></li>
                                 <li><a class='active' href='editor_maitenance.php'>Manutenzione Sito</a></li>
                                 <li><a href='news_list.php'>Gestione Notizie</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/news_list.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='admin_manager.php'>User Editor</a></li>
                                 <li><a href='editor_maitenance.php'>Manutenzione Sito</a></li>
                                 <li><a class='active' href='news_list.php'>Gestione Notizie</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/news_editor.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='news_list.php'>Torna a Gestione Notizie</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/news_editor_add.php": 
                    case "/admin_mgr_tools/news_delete.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='news_list.php'>Torna a Gestione Notizie</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/rankdown.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='admin_manager.php'>Torna all'User Editor</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/rankup.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='admin_manager.php'>Torna all'User Editor</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/ban.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='admin_manager.php'>Torna all'User Editor</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/admin_mgr_tools/unban.php": {
                         echo "<ul>
			                     <li><a class='logout' href='../index.php'>Esci dal Pannello</a></li>
                                 <li><a href='admin_manager.php'>Torna all'User Editor</a></li>
                                 <li><i><font color=white>Connesso come: <b>".$_SESSION["username"]."</b></i>!</font></li>
		                      </ul>";
                        break;                       
                    }
                    case "/user_editor/change_password.php": {
                         echo "<ul>
                                 <li><a href='../me.php'>Home</a></li>
		                      </ul>";
                        break;                       
                    }
                } 
            ?>
		</ul>
	</nav>
</header>
<br> <br> <br> <br>
</html>