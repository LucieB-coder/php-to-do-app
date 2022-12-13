<!DOCTYPE html>
<html>
    <head>
        <title>connection</title>
        <link rel="stylesheet" href="styles/commonStyles.css">
    </head>
    <body>
        <header>
            <h1>Join the good side of the force</h1>
            
        </header>
        <div>
            <form method="POST" name="inscription" id="inscription">
                <h2>Please enter all the informations :</h2>
                <p>Login
                    <input type="text" name="username" required/></p>
                <p>Password
                <input type="password" name="password" required/></p>
                <p>Confirm Password
                <input type="password" name="confirmpassword" required/></p>
                <br/>
                <input class="button" type="submit" value="Sign Up"/>
                <input type="hidden" name="action" value="inscription"/>
            </form>
        </div>
    </body>
</html>