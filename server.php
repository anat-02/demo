<?php 
session_start();

$servername = "localhost";
$username = "user1";
$password = "password1";
$dbname = "demo";

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
        $password = password_hash($password, PASSWORD_DEFAULT);
        /*$password = md5($password);*/
        $query = "insert into users (username, password, role) values (?, ?, 'cu')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $_SESSION['username'] = $username;
  	    $_SESSION['login_success'] = "You are now logged in";
  	    header('location: complaintform.php');
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
        /*$password = md5($password);*/

        $query = "select * from users where username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            if(password_verify($password, $row['password'])){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                if($_SESSION != "ad"){
                    header('location: complaintform.php');
                }
                elseif($_SESSION['role']==="ad"){
  	                header('location: allcomplaints.php');
                }
            } 
            
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
        $query = "insert into complaints (username, user_id, type, description, method, urgent, status) values (?, ?, ?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $_SESSION['username'], $_SESSION['user_id'], $menu, $description, $method, $urgent);
        if($stmt->execute()){
            $_SESSION['submission'] = "successful";
            header('location: complaintslist.php?submission=successful');
        }
        else {
            $_SESSION['submission'] = "failed";
        }
        
    }
}

$status = "";

//UPDATE STATUS OF COMPLAINT
if($_POST['status']){
    $status = $_POST["status"];
    $id = $_POST["id"];
    $query = "update complaints set status = ? where id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $status, $id);
    $stmt->execute();
    $_SESSION['update_success'] = "Complaint updated successfully";
}
?>