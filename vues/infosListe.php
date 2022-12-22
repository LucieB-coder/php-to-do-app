<!DOCTYPE html>
<html>
    <head>
        <title>detailList</title>
        <link rel="stylesheet" href="styles/commonStyles.css"/>
        <link rel="stylesheet" href="styles/detailsListStyles.css"/>
    </head>
    <body>
        <header>
            <form method="POST" name="goBackHome" id="GoHome"> 
                <input type="image" src="assets/logo.png"/>
                <input type="hidden" name="action" value="goHome"/>
            </form>
            <h1><?=$dataView->get_nom()?></h1>
        </header>
        <div class="body">
            <?php 
                if (isset($dataView)) {
                    if($dataView->get_taches() != null){
                        foreach($dataView->get_taches() as $tache){
                            if($tache->get_isCompleted() == true){
                                echo '
                                <div class="tache">
                                    <form method="POST" id="check" name="check">
                                        <input type="image" src="assets/done.png"/>
                                        <input type="hidden" name="action" value="changeCompletedTache"/>
                                        <input type="hidden" name="tache" value="'.$tache->get_id().'"/>
                                        <input type="hidden" name="liste" value="'.$dataView->get_id().'"/>
                                    </form>
                                    <h4>'.$tache->get_nom().'</h4>
                                
                                ';
                            }
                            else{
                                echo '
                                <div class="tache">
                                    <form method="POST" id="uncheck" name="uncheck">
                                        <input type="image" src="assets/to-do.png"/>
                                        <input type="hidden" name="action" value="changeCompletedTache"/>
                                        <input type="hidden" name="tache" value="'.$tache->get_id().'"/>
                                        <input type="hidden" name="liste" value="'.$dataView->get_id().'"/>
                                    </form>
                                    <h4>'.$tache->get_nom().'</h4>
                                ';
                            }
                            echo '
                            <form method="POST" id="delTache" name="delTache">
                                <input type="image" src="assets/bin.png"/>
                                <input type="hidden" name="action" value="delTache"/>
                                <input type="hidden" name="tache" value="'.$tache->get_id().'"/>
                                <input type="hidden" name="liste" value="'.$dataView->get_id().'"/>
                            </form>
                            </div>';
                            echo '<br/>';
                        }
                    }
                }
            ?>
            <form method="POST" id="addTache" name="addTache">
                <input class="add-task" type="submit" value="Add a Task"/></p>
                <input type="hidden" name="action" value="accessCreationTachePage"/>
                <input type="hidden" name="liste" value="<?=$dataView->get_id()?>"/>
            </form>
            
            <form method="POST" id="delListe" name="delListe">
                <input class="del-list" type="submit" value="Delete the list"/></p>
                <input type="hidden" name="action" value="delListe"/>
                <input type="hidden" name="liste" value="<?=$dataView->get_id()?>"/>
            </form>
        </div>
    </body>
</html>