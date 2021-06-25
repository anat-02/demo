<?php include('server.php'); 

$username = $_SESSION['username'];
$query = "select * from complaints where username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Complaints List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="scripts.js"></script>
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
                        <a class="nav-link active" aria-current="page" href="complaintform.php">Complaint Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=".#">Complaints List</a>
                    </li>
                </ul>
                <span class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </span>
            </div>
        </div>
    </nav>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Complaint ID:</th>
                <th scope="col">Type of Issue:</th>
                <th scope="col">Description</th>
                <th scope="col">Payment Method:</th>
                <th scope="col">Urgency:</th>
                <th scope="col">Status:</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <th scope="row"><?php echo $row['id']; ?></th>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['method']; ?></td>
                <td><?php echo $row['urgent']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>