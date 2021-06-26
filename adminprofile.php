<?php include('server.php'); 

$username = $_SESSION['username'];
$query = "select * from users where username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
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
                        <a class="nav-link" href="allcomplaints.php">All Complaints</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Profile</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </span>
            </div>
        </div>
    </nav>

    <div class="container d-grid gap-3">
        <form class="form">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" class="form-control" disabled value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" disabled value="<?php echo $row['password']; ?>">
            </div>
        </form>
    </div>

</body>

</html>