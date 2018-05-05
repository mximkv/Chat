 <?php
 session_start();
 include_once 'src/DB.php';
 if (!isset($_SESSION['name'])){
	 		header("Location: login.php");
	 
 }
 $model = new DB ();
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
<body class = "pizda">
<link rel='stylesheet' href='style.css'>
<h1 style="text-align:center;">Добро пожаловать в еблочат</h1>
<p style="text-align:center;">Введите ваше имя:</p>

  <form style="text-align:center;" action="chatroom.php" method="post">

Text:&nbsp;<input type="text" name="text"><br>

  <input type="submit" name="submit" value="ок">
</form>

  
<?php
if (isset( $_POST['text'])){
$model->sendMessage($_POST['text'],$_SESSION['name']);
}
?>

<?php
$messages = $model->getChatList();
?>
<?php
echo "welcome ".$_SESSION['name'];

?>


<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Text</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($messages as $showItem){ ?>
        <tr>
            <td><?php echo $showItem['id']?></td>
            <td><?php echo $showItem['name']?></td>
            <td><?php echo $showItem['text']?></td>
            <td><?php echo $showItem['date']?></td>
        </tr>
    <?php } ?>

    </tbody>

</table>





<a href="logout.php">Logout</a>


</body>
</html>

