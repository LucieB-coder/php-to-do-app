<!DOCTYPE html>
<html>
    <header>
        <h2><?=$dataView->nom?></h2>
        <form method="POST" name="goBackHome" id="Go Home">
            <input type="submit" value="Home Page"/>
            <input type="hidden" name="action" value="goHome"/>
        </form>
    </header>
    <body>
        <div>
            <?php 
                if (isset($dataView)) {
                    if($dataView->taches != null){
                        foreach($dataView->taches as $tache){
                            if($tache->isCompleted == true){
                                echo '
                                <input type="checkbox" id="tache'.$tache->id.'" name="tache'.$tache->id.'" value="'.$tache->id.'" disabled checked>
                                <label for="tache'.$tache->id.'">'.$tache->nom.'</label>
                                <form method="POST" id="check'.$tache->id.'" name="check'.$tache->id.'">
                                    <input type="submit" value="Undo"/>
                                    <input type="hidden" name="action" value="changeCompletedTache"/>
                                    <input type="hidden" name="tache" value="'.$tache->id.'"/>
                                    <input type="hidden" name="liste" value="'.$dataView->id.'"/>
                                </form>
                                ';
                            }
                            else{
                                echo '
                                <input type="checkbox" id="tache'.$tache->id.'" name="tache'.$tache->id.'" value="'.$tache->id.'" disabled>
                                <label for="tache'.$tache->id.'">'.$tache->nom.'</label>
                                <form method="POST" id="uncheck'.$tache->id.'" name="uncheck'.$tache->id.'">
                                    <input type="submit" value="Done"/>
                                    <input type="hidden" name="action" value="changeCompletedTache"/>
                                    <input type="hidden" name="tache" value="'.$tache->id.'"/>
                                    <input type="hidden" name="liste" value="'.$dataView->id.'"/>
                                </form>
                                ';
                            }
                            echo '
                            <form method="POST" id="delTache'.$tache->id.'" name="delTache'.$tache->id.'">
                                <input type="submit" value="Delete"/>
                                <input type="hidden" name="action" value="delTache"/>
                                <input type="hidden" name="tache" value="'.$tache->id.'"/>
                                <input type="hidden" name="liste" value="'.$dataView->id.'"/>
                            </form>';
                            echo '<br/>';
                        }
                    }
                }
            ?>
            <form method="POST" id="addTache" name="addTache">
                <input type="submit" value="Add a Task"/></p>
                <input type="hidden" name="action" value="accessCreationTachePage"/>
                <input type="hidden" name="liste" value="<?=$dataView->id?>"/>
            </form>
            <form method="POST" id="delListe" name="delListe">
                <input type="submit" value="Delete the list"/></p>
                <input type="hidden" name="action" value="delListe"/>
                <input type="hidden" name="liste" value="<?=$dataView->id?>"/>
            </form>
        </div>
    </body>
</html>