<?php     include("./Includes/connexion.inc.php");

$SID=$_COOKIE['nom'];

setcookie("nom","", time()-1, "/");
$query="UPDATE user SET sid=:SID WHERE sid=:SID";
$prep = $pdo->prepare($query);
$prep->bindValue(':SID', $SID);
$prep->execute();
header('Location: http://localhost/Microblog/login.php');