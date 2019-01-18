<?php
include("connexion.inc.php");

$login = $_POST['login'];
$pwd = $_POST['pwd'];

// $query="SELECT * FROM user WHERE login='".$_POST['login']."' AND pwd='".$_POST['pwd']."'";
$query="SELECT * FROM user WHERE login=:login AND pwd=:pwd";

$prep = $pdo->prepare($query);
$prep->bindValue(':login', $_POST['login']);
$prep->bindValue(':pwd', $_POST['pwd']);
$prep->execute();
$data=$prep->fetch();


    if($data['pwd'] !== $_POST['pwd']){
        
        header('Location: http://localhost/Microblog/login.php');
    }
    else
    {
        echo "vous êtes bien connecté : ".$data['login'];
        $SID = md5($_POST['login']+time());
setcookie("nom",$SID, time()+60, "/");

$query="UPDATE user SET sid=:SID WHERE login=:login AND pwd=:pwd";
$prep = $pdo->prepare($query);
$prep->bindValue(':SID', $SID);
$prep->bindValue(':login', $_POST['login']);
$prep->bindValue(':pwd', $_POST['pwd']);
$prep->execute();

header('Location: http://localhost/Microblog/index.php');
    }