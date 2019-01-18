<html>

<body>
    <?php include("Includes/haut.inc.php"); ?>

    <form class="form-inline" method="POST" action="includes/action.php" id="formulaireLogin">

        <div class="form-group">
            <label for="email">Login:</label>
            <input type="text" name="login" class="form-control" id="login">
        </div>

        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" class="form-control" id="pwd">
        </div>

        <button type="submit" class="btn btn-default">Connexion</button>

        <div class="alert alert-danger hide" id="notification">
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

