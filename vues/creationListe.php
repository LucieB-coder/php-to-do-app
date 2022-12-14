<!DOCTYPE html>
<html>
    <body>
        <div>
            <h3>Create a new list</h3>
            <form method="POST" name="creaListe" id="creaListe">
                <p>Name of the list
                    <input type="text" name="name" id="name" required/></p>
                <?php
                if(isset($_SESSION['login'])){
                    echo '<input type="checkbox" id="private" name="private">
                          <label for="private">Private List?</label>';
                }
                ?>
                <input class="button" type="submit" value="Create List"/>
                <input type="hidden" name="action" value="creerListe"/>
            </form>
        </div>
    </body>
</html>