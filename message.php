<?php include("Includes/connexion.inc.php"); ?>


<?php

$date = time();
if(!isset($_POST['id']) && (!isset($_GET['id']))){
    $query = "INSERT INTO messages (contenu, date) VALUES (:contenu, :date)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':contenu', $_POST['message']);
    $prep->bindValue(':date', time());
    $prep->execute();
   }
   else
   {
      //if($_GET['a']=='vote')
	   if($_GET['a']=='sup')
		   $pdo->query("DELETE FROM messages WHERE id='".$_GET['id']."'");
		else {  
	   $query = 'UPDATE messages SET contenu=:contenu, date=:date WHERE id=:id';

    $prep = $pdo->prepare($query);
    $prep->bindValue(':contenu', $_POST['message']);
    $prep->bindValue(':date', time());
    $prep->bindValue(':id', $_POST['id']);
    $prep->execute();
		 }
   }
header("Location:index.php");
?>