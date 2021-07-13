<?php include('server.php'); 

if($_SESSION['role']!= "ad"){
    header('location: complaintform.php');
}

$query = "select * from complaints";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Complaints</title>
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
                        <a class="nav-link active" aria-current="page" href="#">All Complaints</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminprofile.php">Profile</a>
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
                <th scope="col">Username:</th>
                <th scope="col">User ID:</th>
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
                <th scope="row"><?php echo $row['complaint_id']; ?></th>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['method']; ?></td>
                <td><?php echo $row['urgent']; ?></td>
                <td>
                    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <select class="form-select" id="status" aria-label="Default select example" name="status"
                                onchange='this.form.submit()'>
                                <option selected><?php echo $row['status']; ?></option>
                                <option value="dismissed">Dismissed</option>
                                <option value="solved">Solved</option>
                            </select>
                        </div>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>