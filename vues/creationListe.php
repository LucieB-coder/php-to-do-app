<!DOCTYPE html>
<html>
    <head>
        <title>creationListe</title>
        <link rel="stylesheet" href="styles/commonStyles.css"/>
        <link rel="stylesheet" href="styles/creationStyles.css"/>
    </head>
    <body>
        <header>
            <form method="POST" name="goBackHome" id="GoHome">
                <input type="image" src="assets/logo.png"/>
                <input type="hidden" name="action" value="goHome"/>
            </form>
            <h1>Create a new list</h1> 
        </header>
        <div class="body">
            <form method="post" name="creationForm" id="creationForm">
                <h4>Name of the list</h4>
                <input type="text" name="name" id="name" required/>
                <?php
                if(isset($_SESSION['login'])){
                    echo '<p>
                                <input type="checkbox" id="private" name="private">
                                <label for="private">Private List?</label>
                            </p>
                            ';
                }
                ?>
                <br/>
                <?php
                if(isset($vues_erreur)){
                    echo '<h4 id="error">'.$vues_erreur[0].'</h4>';
                }
                ?>
                <input class="button" type="submit" value="Create List"/>
                <input type="hidden" name="action" value="creerListe"/>
            </form>
        </div>
    </body>
</html>