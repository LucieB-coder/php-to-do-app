<!DOCTYPE html>
<html>
    <header>
        <h2>Private Lists</h2>
        <form method="POST" name="goBackHome" id="Go Home">
            <input type="submit" value="Home Page"/>
            <input type="hidden" name="action" value="goHome"/>
        </form>
    </header>
    <body>
        <div>
            
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

        </div>
    </body>
</html>