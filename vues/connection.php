<!DOCTYPE html>
<html>
    <head>
        <title>connection</title>
        <link rel="stylesheet" href="styles/commonStyles.css"/>
        <link rel="stylesheet" href="styles/connectionStyles.css"/>
    </head>
    <body>
        <header>
            <form method="POST" name="goBackHome" id="GoHome">
                <input type="image" src="assets/logo.png"/>
                <input type="hidden" name="action" value="goHome"/>
            </form>
            <h1>You are back ?!</h1> 
        </header>
        <div class="body">
            <form method="POST" name="connectionForm" id="connectionForm">
                <h4>Username</h4>
                    <input type="text" name="login" required/>
                <h4>Password</h4>
                <input type="password" name="mdp" required/>
                <?php
                if(!empty($vues_erreur)){
                    echo '<h4 id="error">Incorrect Username or Password</h4>';
                }
                ?>
                <input class="button" type="submit" value="Log In"/>
                <input type="hidden" name="action" value="connection">
            </form>
            <br/>
            <br/>
            <h2>You are new here?</h2>
            <form method="POST" name="accessInscription" id="accesInscription">   
                <input class="accesInscription" type="submit" value="Sign Up"/>
                <input type="hidden" name="action" value="accessInscription">
            </form>
        </div>
    </body>
</html>

