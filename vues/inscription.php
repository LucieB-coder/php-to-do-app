<!DOCTYPE html>
<html>
    <head>
        <title>connection</title>
        <link rel="stylesheet" href="<?=$styles['commun']?>">
        <link rel="stylesheet" href="<?=$styles['connection']?>">
    </head>
    <body>
        <header>
            <form method="POST" name="goBackHome" id="GoHome"> 
                <input type="image" src="assets/logo.png"/>
                <input type="hidden" name="action" value="goHome"/>
            </form>
            <h1>Join the good side of the force</h1>
        </header>
        <div class="body">
            <h2>Please enter all the informations :</h2>
            <form method="POST" name="inscription" id="connectionForm"> 
                <h4>Login</h4>
                <input type="text" name="username" required/>
                <h4>Password</h4>
                <input type="password" name="password" required/>
                <h4>Confirm Password</h4>
                <input type="password" name="confirmpassword" required/>
                <br/>
                <input class="button" type="submit" value="Sign Up"/>
                <input type="hidden" name="action" value="inscription"/>
            </form>
        </div>
    </body>
</html>