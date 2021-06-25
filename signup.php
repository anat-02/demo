<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <div class="container d-grid gap-3">
        <h1>Suggestions Box</h1>
        <h2 id="title">Sign Up</h2>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <span class="error form-control-sm"><?php echo $username_err; ?></span>
                <input type="text" class="form-control" id="username" placeholder="Create Username" name="username"
                    value="<?php echo $username; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <span class="error form-control-sm"><?php echo $password_err; ?></span>
                <input type="password" class="form-control" id="password" placeholder="Create Password" name="password"
                    value="<?php echo $password; ?>">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <span class="error form-control-sm"><?php echo $confirm_password_err; ?></span>
                <input type="password" class="form-control" id="confirm_password" placeholder="Enter Password Again"
                    name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span class="error"><?php echo $does_not_match_err; ?></span>
            </div>

            <button type="submit" name="signup" value="Submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="login.php">Existing user? Click here to login</a>
    </div>
</body>

</html>