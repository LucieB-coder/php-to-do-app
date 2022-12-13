<!DOCTYPE html>
<html>
    <body>
        <div>
            <h2>Private Lists</h2>
            <?php
            if (isset($dataView)) {
                foreach ($dataView as $liste){
                    echo $liste->nom;
                    echo '<br/>';
                    if($liste->taches != null){
                        foreach($liste->taches as $tache){
                            echo '    * '.$tache->nom;
                            echo '<br/>';
                        }
                    }
                }
            }
            ?>

        </div>
    </body>
</html>