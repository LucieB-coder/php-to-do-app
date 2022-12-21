<!DOCTYPE html>
<html>
    <head>
        <title>creationTache</title>
        <link rel="stylesheet" href="<?=$styles['commun']?>">
        <link rel="stylesheet" href="styles/creationStyles.css">
    </head>
    <body>
        <header>
            <form method="POST" name="goBackHome" id="GoHome"> 
                <input type="image" src="assets/logo.png"/>
                <input type="hidden" name="action" value="goHome"/>
            </form>
            <h1>Create a new task</h1>
        </header>
        <div class="body">
            <form method="post" name="creationForm" id="creationForm">
                <h4>Name of the task</h4>
                <input type="text" name="name" id="name" required/>
                <input class="button" type="submit" value="Create"/>
                <input type="hidden" name="action" value="addTache"/>
                <input type="hidden" name="liste" value="<?=$dataView?>"/>
            </form>
        </div>
    </body>
</html>