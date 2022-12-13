<!DOCTYPE html>
<html>
    <head>
        <title>connection</title>
        <link rel="stylesheet" href="styles/commonStyles.css">
    </head>
    <body>
        <header>
            <h1>You are back ?!</h1>
        </header>
        <div>
            <form method="POST" name="connectionForm" id="connectionForm">
                <p>Login
                    <input type="text" name="login" required/></p>
                <p>Password
                <input type="password" name="mdp" required/></p>
                <br/>
                <br/>
                <input class="button" type="submit" value="Log In"/>
                <input type="hidden" name="action" value="connection">
            </form>
            <br/>
            <br/>
        </div>
        <div>
            <form method="POST" name="accessInscription" id="accesInscription">
                <h2>You are new here?</h2>
                <input class="button" type="submit" value="Sign Up"/>
                <input type="hidden" name="action" value="accessInscription">
            </form>
        </div>
    </body>
</html>