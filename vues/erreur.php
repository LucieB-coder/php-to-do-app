<!DOCTYPE html>
<html>
    <body>
        <div>
            <h3>Error!</h3>
            
            <?php
            if (isset($dataVueErreur)) {
                foreach ($dataVueErreur as $value){
                    echo $value;
                }
            }
            ?>

        </div>
    </body>
</html>