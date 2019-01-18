<?php
include("connexion.inc.php");

if(isset($_GET['id']) && $_GET['id'] != "")
{
    $id=$_GET['id'];
    $ip = get_ip();

    $query="SELECT * FROM messages WHERE id=:id";
    $prep=$pdo->prepare($query);
    $prep->bindValue(':id', $id);
    $prep->execute();
    $data=$prep->fetch();

    if($ip != $data['adresse_ip'])
    {
        $query="UPDATE messages SET votes=votes+1, adresse_ip=:ip WHERE id=:id";
        $prep=$pdo->prepare($query);
        $prep->bindValue(':id', $id);
        $prep->bindValue(':ip', $ip);
        $prep->execute();

        $query="SELECT * FROM messages WHERE id=:id";
        $prep=$pdo->prepare($query);
        $prep->bindValue(':id', $id);
        $prep->execute();
        $data=$prep->fetch();
        echo $data['votes'];
    }
    else
        echo "deja";
}
/**
 * Récupérer la véritable adresse IP d'un visiteur
 */
function get_ip() {
	// IP si internet partagé
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	// IP derrière un proxy
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	// Sinon : IP normale
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}
?>