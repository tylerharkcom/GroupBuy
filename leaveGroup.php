<?php
	session_start();

	// Get user info from session
	$gid = $_GET['gid'];
	$userID = $_SESSION['userID'];
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];

	$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

	$check = $conn->prepare("DELETE FROM groupinfo WHERE userid = ?");
	$check->bind_param('s', $userID);
	$check->execute();

	$conn->close();
?>

<?php if(isset($_SESSION['firstName'])) { ?>
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
								<li class="active"><a href="items.php">Items</a></li>
								<li><a href="group-page.php">Group</a></li>
								<li><a href="logout.php">Log Out</a></li>
								<li><a href="admin.html">Admin</a></li>
							</ul>
						</div>
					</nav>
				</header>
				<div class="container">
					<div class="border">

						<h1>Successfully left Group #<?php echo $gid ?>!</h1>
						<a href="group-page.php">Return to group page.</a></li>

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
                <li class="active"><a href="items.php">Items</a></li>
                <li><a href="group-page.php">Group</a></li>
                <li><a href="logout.php">Log Out</a></li>
                <li><a href="admin.html">Admin</a></li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="container">
          <div class="border">
            <h1>Please <a href="login.html">log in</a> to view items.</h1>
          </div>
        </div>
    </body>
  </html>

<?php } ?>
