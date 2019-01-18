<html>

<body>
    <?php include("Includes/haut.inc.php"); ?> <!-- on insère l'entête de la page -->

    <form class="form-inline" method="POST" action="Includes/action.php" id="formulaireLogin"> <!-- on crée un formulaire
    avec un envoi par la méthode post qui ouvrira la page action.php -->

        <div class="form-group"> <!-- on crée une DIv pour gérer le login -->
            <label for="email">Login:</label> <!-- on insére le label login -->
            <input type="text" name="login" class="form-control" id="login"> <!-- on insère un champ de saisie pour récupérer le login -->
        </div>

        <div class="form-group"> <!-- on crée une DIv pour gérer le password -->
            <label for="pwd">Password:</label> <!-- on insére le label password -->
            <input type="password" name="pwd" class="form-control" id="pwd"> <!-- on insère un champ de saisie pour récupérer le password -->
        </div>

        <button type="submit" class="btn btn-default">Connexion</button> <!-- création d'un bouton de connexion qui enverra le contenu du formulaire
        via la ma péthode post -->

        <div class="alert alert-danger hide" id="notification"> <!-- on insère une div qui fera apparaitre les messages d'erreur -->
        </div>

    </form>

    <script>
        $("#formulaireLogin").submit(function(event) {
            //event.preventDefault();
                        
            $("#notification").removeClass();
            if ($("#login").val() == "") {
                
                $("#notification").html("Désolé, il faut remplir le champ Login");
                $("#notification").addClass("alert alert-danger");
                return false;
                
            } else 
                if ($("#pwd").val() == "") {
                $("#notification").html("Désolé, il faut remplir le champ Password");
                $("#notification").addClass("alert alert-danger");
                return false;    
            }        

            $("#notification").empty();
            // event.preventDefault();
            return true;           
        });
    </script>

    <?php include("includes/bas.inc.php"); ?>

