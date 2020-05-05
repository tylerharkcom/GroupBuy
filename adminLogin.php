<?php
	session_start();

	$validUser = false;
	$username = $_POST['username'];
	$pass = $_POST['password'];

	$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

	// echo "Connected successfully";

	// $message = $conn->query("SELECT message FROM myTable")->fetch_object()->message;
	// $conn->close();
	// echo "$message <br/>";
	// echo "Hello From Sites Folder!";

	// $sql = "SELECT * FROM users WHERE email = '".$email."'";

	$sql = $conn->prepare("SELECT * FROM `admin` where username = ? AND pass = ?");
	$sql->bind_param('ss', $username, $pass);
	$sql->execute();

	$result = $sql->get_result();

	if ($result->num_rows > 0)
	{
		$validUser = true;

		$row = $result->fetch_assoc();
		$userID = $row["aid"];
		$username = $row["username"];
		$_SESSION['adminUserID'] = $userID;
		$_SESSION['username'] = $username;
	}

		$conn->close();
?>

<?php if($validUser == false) { ?>
	<!--Wrong username or password. Try again.-->
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
						<span><a href="admin.html">Admin Login</a></span>
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
									<li><a href="login.html">Login</a></li>
									<li class="active"><a href="admin.html">Admin</a></li>
		            </ul>
		          </div>
		        </nav>
		      </header>
		      <div class="container">
		        <div class="border">

							<p> Thanks for logging in, <?php echo $_SESSION['username'] ?>. </p>
							<span><a href="adminPage.php">Admin Page</a></span>

		        </div>
		      </div>
		  </body>
		</html>
	<?php } ?>
