<?php 
session_start();
require_once 'Connexion.php';
$listCours = listCours(); 
$_SESSION['cours'] = $listCours;
$listNotion = listNotionForChatBot(); 
$_SESSION['lecon'] = $listNotion;
$listQuest = listQuest(); 
$_SESSION['quest'] = $listQuest;
?>
 <script src="widget.js"></script>
	  <script>
        var botmanWidget = {
            frameEndpoint: 'chat.html',
            introMessage: 'Hello',
            chatServer : 'botman.php', 
            title: 'LAB'
        }; 
</script>
