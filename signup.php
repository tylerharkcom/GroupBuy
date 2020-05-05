<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <head>
      <meta charset="utf-8">
      <title>DB Project</title>

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <!-- local CSS style sheet -->
      <link rel="stylesheet" type="text/css" href="db-style.css">

    </head>
    <body>
      <header>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Shopping Application</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="items.php">Items</a></li>
              <li><a href="group-page.php">Group</a></li>
							<li><a href="login.html">Login</a></li>
              <li><a href="admin.html">Admin</a></li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="container">
        <div class="border">

					<?php
						// Establish connection
						$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

						// Check connection
						if ($conn->connect_error)
						{
							die("Connection failed: " . $conn->connect_error);
						}
						// echo "Connected successfully";

						// $message = $conn->query("SELECT message FROM myTable")->fetch_object()->message;
						// $conn->close();
						// echo "$message <br/>";
						// echo "Hello From Sites Folder!";

						$email = $_POST['email'];
						$password = $_POST['password'];
						// $password2 = $_POST['confirmPass'];
						$firstName = $_POST['firstName'];
						$lastName = $_POST['lastName'];
						$address = $_POST['address'];
						$creditCard = $_POST['creditCard'];

						$sql = "INSERT INTO users (firstName, lastName, email, pass, address, creditCard) VALUES ('$firstName', '$lastName', '$email', '$password', '$address', '$creditCard')";

						if ($conn->query($sql) !== TRUE)
						{
				    	echo "Error: " . $sql . "<br>" . $conn->error;
						}

						$conn->close();
					?>

					<p> Thanks for signing up, <?php echo $firstName ?> <?php echo $lastName ?>. </p>

					<span>Please <a href="login.html">log in</a>.</span>


        </div>
      </div>
  </body>
</html>
