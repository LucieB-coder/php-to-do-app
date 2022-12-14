<!DOCTYPE html>
<html>

<head>
    <title>Acceuil</title>
    <link rel="stylesheet" href="../vues/styles/commonStyles.css">
</head>
<body>
    <header>
        <h1>Welcome to our fantastic to do list app !</h1>
        <?php
        if(!isset($_SESSION['login'])){
            echo '
        <div>
        <form method="post" name="connection" id="connection">
            <input class="button" type="submit" value="Connection"/>
            <input type="hidden" name="action" value="accessConnectionPage"/>
        </form>
        </div>';
        }
        else{
            echo'
        <div>
        <form method="post" name="profil" id="profil">
            <input class="button" type="submit" value="Profile"/>
            <input type="hidden" name="action" value="accessProfilePage"/>
        </form>
        </div>';
        }?>
    </header>
    <?php if(isset($_SESSION['login'])){
    echo '
    <div>
        <form method="post" name="listesPv" id="listesPv">
            <input class="button" type="submit" value="Access private lists"/>
            <input type="hidden" name="action" value="accessPrivateLists"/>
        </form>
    </div>';   
    }?>
    
    <div>
        <h2>Public Lists</h2>
        <?php
            if(isset($dataView)) {
                foreach ($dataView as $liste){
                    echo '
                    <div>
                        <form method="post" name="accessList" id="accessList">
                            <p>• '.$liste->nom.'
                            <input type="submit" value="View List"/></p>
                            <input type="hidden" name="action" value="accessListInfos"/>
                            <input type="hidden" name="liste" value="'.$liste->id.'"/>
                        </form>
                    </div>';
                }
            }
        ?>
        <div>
            <form method="post" name="createList" id="createList">
                <input class="button" type="submit" value="Create List"/>
                <input type="hidden" name="action" value="accessCreationListePage"/>
            </form>
        </div>
    </div>
</body>
</html>