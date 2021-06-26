<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <div class="container d-grid gap-3"> 
        <h1>Demo Company Complaints</h1>
        <h2 id="title">Login</h2>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <span class="error form-control-sm"><?php echo $username_err; ?></span>
                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username"
                    value="<?php echo $username; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <span class="error form-control-sm"><?php echo $password_err; ?></span>
                <span class="error"><?php echo $does_not_match_err; ?></span>
                <input type="password" type="password" class="form-control" id="password" placeholder="Enter Password"
                    name="password" value="<?php echo $password; ?>">
            </div>

            <button type="submit" name="login" value="Submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="signup.php">New user? Click here to sign up</a>
    </div>
</body>

</html>