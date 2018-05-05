 <?php
 session_start();
 include_once 'src/DB.php';
 if (isset($_SESSION['name']))
 {
	 header("Location: chatroom.php");
	 
 }
 ?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>
<body>


<h1 style="text-align:center;">Добро пожаловать в еблочат</h1>
<p style="text-align:center;">регайся:</p>
<form style="text-align:center;" action="reg.php" method="post">

    <div class="form-group">
        <label for="exampleInputEmail1">Login</label>
        <input type="login" name="user_name" class="form-control" id="exampleInputLogin" aria-describedby="login" placeholder="New Login">
        <small id="emailHelp" class="form-text text-muted">We'll never share your login with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <div style="color:red;"> <?php
        if( isset($_SESSION['error']) && $_SESSION['error']){
            echo $_SESSION['error'];
            unset($_SESSION['error']);


        }
        ?>
    </div>
</form>



<?php


// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["user_name"])) {
        $nameErr = "Name is required";
        $_SESSION["error" ] = $nameErr;
        header("Location: reg.php");
        exit();
    } else {
        $name = test_input($_POST["user_name"]);
        // check if name only contains letters and whitespace
        if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
            $nameErr = "Invalid email format";
            $_SESSION["error" ] = $nameErr;
            header("Location: reg.php");
            exit();
        }
    }

if (empty ($_POST["pass"])){
        $nameErr = "UR pass is empty";
        $_SESSION["error" ] = $nameErr;
        header("Location: reg.php");
        exit();
    }



//отправили ли мы форму
    if (isset($_POST['user_name']) && isset($_POST['pass'])) {
        $model = new DB();
        $result = $model->isUserRegistered($_POST['user_name'], $_POST['pass']);
        if (!$result) {
            $model->registerUser($_POST['user_name'], $_POST['pass']);
            $_SESSION['name'] = $_POST['user_name'];
            header("Location: chatroom.php");
        } else {
            echo 'already have this name';
        }

    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



</body>
</html>