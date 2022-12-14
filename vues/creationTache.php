<!DOCTYPE html>
<html>
    <body>
        <div>
            <h3>Create a new list</h3>
            <form method="POST" name="creaListe" id="creaListe">
                <p>Name of the task
                    <input type="text" name="name" id="name" required/></p>
                <input class="button" type="submit" value="Create Tache"/>
                <input type="hidden" name="action" value="addTache"/>
                <input type="hidden" name="liste" value="<?=$dataView?>"/>
            </form>
        </div>
    </body>
</html>