<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Demo Company</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Complaint Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="complaintslist.php">Complaints List</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </span>
            </div>
        </div>
    </nav>

    <div class="container d-grid gap-3">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label for="menu">Type of Issue</label>
                <span class="error form-control-sm"><?php echo $menu_err; ?></span>
                <select class="form-select" id="menu" aria-label="Default select example" name="menu">
                    <option selected>Select</option>
                    <option value="payment failed">Payment Failed</option>
                    <option value="refund">Refund</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <span class="error form-control-sm"><?php echo $description_err; ?></span>
                <textarea class="form-control" name="description" id="description" rows="3"
                    value="<?php echo $description; ?>"></textarea>
            </div>

            <div class="form-group">
                <label for="method">Payment Method:</label>
                <span class="error form-control-sm"><?php echo $method_err; ?></span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="method" id="method" value="mastercard">
                    <label class="form-check-label" for="method">
                        MasterCard
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="method" id="method" value="visa">
                    <label class="form-check-label" for="method">
                        Visa
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="method" id="method" value="cash">
                    <label class="form-check-label" for="method">
                        Cash
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="urgent">Urgent:</label>
                <span class="error form-control-sm"><?php echo $urgent_err; ?></span>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Y" id="urgent" name="urgent">
                    <label class="form-check-label" for="urgent">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="N" id="urgent" name="urgent">
                    <label class="form-check-label" for="urgent">
                        No
                    </label>
                </div>
            </div>

            <button type="submit" name="complaint" value="Submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>