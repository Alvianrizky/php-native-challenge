<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container-fluid">
        <h2>Login</h2>
        <div class="bg">
            <form action="action.php?aksi=login" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="input" placeholder="Input username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input" placeholder="Input password" required>

                <input type="submit" value="Login" class="button">
                <h5>Don't have an account ? <span><a href="register.php">Register here</a></span></h5>
            </form>

        </div>
    </div>
</body>

</html>