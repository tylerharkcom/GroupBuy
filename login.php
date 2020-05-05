<?php
	session_start();

	$validUser = false;
	$email = $_POST['email'];
	$password = $_POST['password'];

	$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

	// echo "Connected successfully";

	// $message = $conn->query("SELECT message FROM myTable")->fetch_object()->message;
	// $conn->close();
	// echo "$message <br/>";
	// echo "Hello From Sites Folder!";

	// $sql = "SELECT * FROM users WHERE email = '".$email."'";

	$sql = $conn->prepare("SELECT * FROM `users` where email = ? AND pass = ?");
	$sql->bind_param('ss', $email, $password);
	$sql->execute();

	$result = $sql->get_result();

	if ($result->num_rows > 0)
	{
		$validUser = true;

		$row = $result->fetch_assoc();
		$userID = $row["id"];
		$firstName = $row["firstName"];
		$lastName = $row["lastName"];
		$_SESSION['userID'] = $userID;
		$_SESSION['email'] = $email;
		$_SESSION['firstName'] = $firstName;
		$_SESSION['lastName'] = $lastName;
	}

		$conn->close();
?>

<?php if($validUser == false) { ?>
	<!--Wrong email or password. Try again.-->
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
	              <li><a href="index.php">Home</a></li>
	              <li><a href="items.php">Items</a></li>
	              <li><a href="group-page.php">Group</a></li>
								<li class="active"><a href="login.html">Login</a></li>
	            </ul>
	          </div>
	        </nav>
	      </header>
	      <div class="container">
	        <div class="border">
						<p> Email not found or password incorrect. Please try again </p>
						<span><a href="login.html">Log in</a></span>
	        </div>
	      </div>
	  </body>
	</html>

	<?php } else { ?>
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
		              <li><a href="index.php">Home</a></li>
		              <li><a href="items.php">Items</a></li>
		              <li><a href="group-page.php">Group</a></li>
									<li class="active"><a href="login.html">Login</a></li>
		            </ul>
		          </div>
		        </nav>
		      </header>
		      <div class="container">
		        <div class="border">

							<p> Thanks for logging in, <?php echo $_SESSION['firstName'] ?> <?php echo $_SESSION['lastName'] ?>. </p>
							<span><a href="index.php">Home page</a></span>

		        </div>
		      </div>
		  </body>
		</html>
	<?php } ?>
