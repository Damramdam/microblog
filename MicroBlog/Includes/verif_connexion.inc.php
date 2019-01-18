<?php 
if(isset($_COOKIE["nom"]))
{
    // $query="SELECT * FROM user WHERE sid='".$_COOKIE['nom']."'";
    $query="SELECT * FROM user WHERE sid=:SID";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':SID', $_COOKIE['nom']);
    $prep->execute();
    $data=$prep->fetch();

// $stmt=$pdo->query($query);
// $data=$stmt->fetch();
    if($data['sid'] == $_COOKIE['nom'])
    {
        $connecte = true;
        $id=$data['id'];
        $email_utilisateur = $data['email'];
        echo "<div class='bravo' style='display:block;' id='bravo'>";
        echo "bravo, vous êtes connecté ! votre adresse mail est: ".$email_utilisateur;
        echo "</div>";   
        
        ?>
<script language="javascript">
    function masquernotification() 
    {
        document.getElementById("bravo").innerHTML = "";
    }
    window.setTimeout(masquernotification, 3000);  
</script>
<?php
    }
    

   
}