<!DOCTYPE html>
<html>

<head>
    <title>Acceuil</title>
    <link rel="stylesheet" href="<?=$styles['commun']?>"/>
    <link rel="stylesheet" href="<?=$styles['acceuil']?>"/>
</head>

<body>
<header>
    <form method="POST" name="goBackHome" id="GoHome"> 
        <input type="image" src="assets/logo.png"/>
        <input type="hidden" name="action" value="goHome"/>
    </form>
    <h1>To-do</h1>
    <?php
    if(!isset($_SESSION['login'])){
        echo '
    <form method="post" name="connection" id="connection">
        <input class="connection" type="submit" value="Connection"/>
        <input type="hidden" name="action" value="accessConnectionPage"/>
    </form>';
    }
    else{
        echo'
    <div>
    <form method="post" name="deconnection" id="deconnection">
        <input class="deconnection" type="submit" value="Deconnection"/>
        <input type="hidden" name="action" value="deconnection"/>
    </form>
    </div>';
    }?>
</header>
<div class="body">
    <div class="head-body">
        <h2>Public Lists</h2>
        <?php if(isset($_SESSION['login'])){
            echo '
            <div>
                <form method="post" name="listesPv" id="listesPv">
                    <input class="private-lists" type="submit" value="Private Lists"/>
                    <input type="hidden" name="action" value="accessPrivateLists"/>
                </form>
            </div>';   
        }?>
    </div>
    <?php
        if(isset($dataView)) {
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
    ?>
    
    <div>
        <form method="post" name="createList" id="createList">
            <input class="create-list" type="submit" value="Create List"/>
            <input type="hidden" name="action" value="accessCreationListePage"/>
        </form>
    </div>
</div>
</body>
</html>