<?php include("Includes/connexion.inc.php"); ?>

<?php include("Includes/haut.inc.php"); ?>

<?php
//include("connexion.inc.php");

$messagesParPage = 5; // variable contenant le nombre de messages par page
$messagesTotalRequete = $pdo->query('SELECT id FROM messages'); // variable contenant tous les messages de la table
$messagesTotal = $messagesTotalRequete->rowCount(); // variable stockant le nombre de lignes (donc de messages) de la table
$pagesTotales = ceil($messagesTotal/$messagesParPage);

// on vérifie si la variable de page existe
if(isset($_GET['page']) AND !empty($_GET['page'])) {
    
    $_GET['page'] = intval($_GET['page']); // On sécurise en "castant" en "int" une éventuelle phrase injectée  
    $pageCourante = $_GET['page']; // on stocke la page courante dans la variable

} else {

    $pageCourante = 1; // si la variable de page n'existe pas, alors la page courante sera la première
}


$depart = ($pageCourante-1)*$messagesParPage;

?>

<!-- creation d'une DIV pour afficher les messages d'alerte -->
<div id="notif" class="" role="alert"></div> 

<section>
    <div class="container">
        <div class="row">
            <form action="message.php" method="POST">
                <div class="col-sm-10">
                    <div class="form-group">
                        <?php
            if(isset($_GET['id'])){
				
                $query = "SELECT * FROM messages where id=:id";
                $prep = $pdo->prepare($query);
                $prep->bindValue(':id',$_GET['id']);
                $prep->execute();
                $data=$prep->fetch();

                echo "<textarea id='message' name='message' class='form-control' placeholder='Message'>";
                echo $data['contenu']."</textarea>";
                echo "<input name='id' type='hidden' value='".$_GET['id']."' />";
            }
            else
                echo "<textarea id='message' name='message' class='form-control' placeholder='Message'></textarea>";
                  ?>

                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success btn-lg">Envoyer</button>

                </div>
            </form>
        </div>
        <?php 
            $query = "SELECT * FROM messages ORDER BY id DESC LIMIT $depart, $messagesParPage";
            $stmt = $pdo->query($query);
            while($data = $stmt->fetch()) {
            echo "<blockquote>";
            echo "<p>";
            echo $data['contenu'];
            echo '<br>';
            echo "<a href='index.php?a=mod&id=".$data['id']."'  class='btn btn-success btn-sm'>Modifier</a>";
            echo "<a href='message.php?a=sup&id=".$data['id']."'  class='btn btn-danger btn-sm'>Supprimer</a>"; 

            if(isset($id)) {

                echo "<a href='#' onClick='ShowModal(this)' data-id='".$data['id']."' id=".'vote'.$data['id']." class='btn btn-info btn-sm'>Voter</a>";
                echo "<b id=".'nbVote'.$data['id'].">".$data['votes']."</b>";     
            }

            echo "</p>";
            echo "<footer>";
            echo "posté le : ";
            echo date("d-m-Y", $data['date']);
            echo " à : ";
            echo date("H:i:s", $data['date']);
            echo "</footer>";
        ?>
        
        </blockquote>

        <?php
            }
            ?>


    </div>

    <?php
    if (empty($_GET['page']) OR $_GET['page']==0){
        $pagePrecedente = 1;
        $pageSuivante = 2;

    }else{

        $pagePrecedente = $_GET['page']-1;
        $pageSuivante = $_GET['page']+1;
    }


    echo '<center><nav>';
    echo '<ul class="pagination justify-content-center">';
    echo '<li class="page-item"><a class="page-link" href="index.php?page='.$pagePrecedente.'">Précédent</a></li>';

    for($i=1;$i<=$pagesTotales;$i++)
    {
    echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a>' ;
    }

    echo '<li class="page-item"><a class="page-link" href="index.php?page='.$pageSuivante.'">Suivant</a></li>';
    echo '</ul>';
    echo '</nav>';
 
    ?>

</section>


<script>
function ShowModal(elem) {
    var dataId = $(elem).data("id");
    var nbVote = "nbVote" + dataId;
    var vote = "vote" + dataId;

    //$("#vote").click(function(){
    // event.preventDefault();
    // id = $("#vote").attr('data-id');
    if (dataId != "") {
        $.ajax({
            url: "Includes/vote.inc.php",
            type: "GET",
            data: "id=" + dataId,
            success: function(result) {
                if (result != "deja") {
                    $("#" + nbVote).html(result);
                    $("#" + vote).attr('disabled', 'true');
                } else if (result == "deja") {
                    $("#notif").removeClass();
                    $("#notif").html("vous avez deja voté !");
                    $("#notif").addClass("alert alert-danger");
                    $("#notif").fadeOut(8000);
                    $("#" + vote).attr('disabled', 'true');
                }
            }
        });
    } else
        window.location.href = 'login.php';
};
</script>

//
<?php include("Includes/bas.inc.php"); ?>