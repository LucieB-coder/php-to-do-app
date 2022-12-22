<!DOCTYPE html>
<html>
    <head>
        <title>Acceuil</title>
        <link rel="stylesheet" href="styles/commonStyles.css"/>
        <link rel="stylesheet" href="styles/acceuilStyles.css"/>
        <link rel="stylesheet" href="styles/privateListsStyles.css"/>
    </head>
    <body>
        <header>
            <form method="POST" name="goBackHome" id="GoHome"> 
                <input type="image" src="assets/logo.png"/>
                <input type="hidden" name="action" value="goHome"/>
            </form>
            <h1>Private lists</h1>
        </header>
        <div class="body">
            
            <?php
            if(isset($dataView) && !empty($dataView)) {
                foreach ($dataView as $liste){
                    echo '
                    <div>
                        <form method="post" name="accessList" id="accessList">
                            <h4>• '.$liste->get_nom().'</h4>
                            <input class="button" type="submit" value="View List"/>
                            <input type="hidden" name="action" value="accessListInfos"/>
                            <input type="hidden" name="liste" value="'.$liste->get_id().'"/>
                        </form>
                    </div>';
                }
            }
            else{
                echo '
                <h2>You do not have any list for the moment</h2>';
            }
            ?>
            <form method="post" name="createList" id="createList">
                <input class="create-list" type="submit" value="Create List"/>
                <input type="hidden" name="action" value="accessCreationListePage"/>
            </form>
        </div>
    </body>
</html>