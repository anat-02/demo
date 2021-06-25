<?php 
session_start();

$servername = "localhost";
$username = "user1";
$password = "password1";
$dbname = "TEST";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$username_err = $password_err = $confirm_password_err = $does_not_match_err = "";
$username = $password = $confirm_password = "";

function clean_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// SIGN UP 
if($_POST['signup']){
    if(empty($_POST["username"])){
        $username_err = "Username is required";
    } else {
        $username = clean_input($_POST["username"]);
        $sql = "select * from users where username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) { 
            if ($row["username"]===$username) {
              $username_err = "Username already exists";
            }
        } 
        $stmt->close();
    }

    if(empty($_POST["password"])){
        $password_err = "Password is required";
    } else {
        $password = clean_input($_POST["password"]);
    }

    if(empty($_POST["confirm_password"])){
        $confirm_password_err = "Confirm password is required";
    } else {
        $confirm_password = clean_input($_POST["confirm_password"]);
        if($password != $confirm_password){
            $does_not_match_err = "Passwords do not match";
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($does_not_match_err)){
        $password = md5($password);
        $query = "insert into users (username, password, role) values (?, ?, 'cu')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $_SESSION['username'] = $username;
  	    $_SESSION['success'] = "You are now logged in";
  	    header('location: homepage.php');
    }
}

// LOGIN
if($_POST['login']){
    if(empty($_POST["username"])){
        $username_err = "Username is required";
    }
    if(empty($_POST["password"])){
        $password_err = "Password is required";
    }
    else {
        $username = clean_input($_POST["username"]);
        $password = clean_input($_POST["password"]);
        $password = md5($password);

        $query = "select * from users where username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) { 
            $_SESSION['username'] = $username;
  	        $_SESSION['success'] = "You are now logged in";
  	        header('location: homepage.php');
        } else {
            $does_not_match_err = "Wrong username/password combination";
        }
        $stmt->close();
    }
}

$menu = $description = $method = $urgent = "";
$menu_err = $description_err = $method_err = $urgent_err = "";

// COMPLAINT FORM
if($_POST['complaint']){
    if(empty($_POST["menu"])){
        $menu_err = "field required";
    } 
    if(empty($_POST["description"])){
        $description_err = "field required";
    }
    if(empty($_POST["method"])){
        $method_err = "field required";
    }
    if(empty($_POST["urgent"])){
        $urgent_err = "field required";
    }
    if(empty($menu_err) && empty($description_err) && empty($method_err) && empty($urgent_err)){
        $menu = $_POST["menu"];
        $description = htmlspecialchars($_POST["description"]);
        $method = $_POST["method"];
        $urgent = $_POST["urgent"];
        $query = "insert into complaints (type, description, method, urgent, status, username) values (?, ?, ?, ?, 'pending', ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $menu, $description, $method, $urgent, $_SESSION['username']);
        $stmt->execute();
        $_SESSION['submission_success'] = "Complaint submitted successfully";
    }
}

// COMPLAINT LIST

?>