<?php
	session_start();

	// Get user info from session
	$gid = $_GET['gid'];
?>

<?php if(isset($_SESSION['username'])) { ?>
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
								<li><a href="adminPage.php">Admin Page</a></li>
								<li><a href="editItems.php">Edit Items</a></li>
								<li class="active"><a href="viewGroups.php">View Group</a></li>
								<li><a href="logout.php">Log Out</a></li>
							</ul>
						</div>
					</nav>
				</header>
				<div class="container">
					<div class="border">
						<h1>Successfully ended Group #<?php echo $gid ?>!</h1>
						<h3>Users will be emailed with an order confirmation.</h3>
						<br>
						<hr>
						<h2>User info from Group #<?php echo $gid ?> is shown below.</h2>
						<h3>Please print this page and send it to Amazon to place user orders.</h3>
						<hr>
						<?php
							$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

							$sql = $conn->prepare("SELECT * FROM groupinfo WHERE gid = ?");
							$sql->bind_param('s', $gid);
							$sql->execute();
							$result = $sql->get_result();

							if ($result->num_rows > 0)
						 	{
								while ($row = $result->fetch_assoc())
								{
									$pid = $row['pid'];
									$userID = $row['userid'];
									$firstName = $row['firstname'];
									$lastName = $row['lastName'];

									$sql2 = $conn->prepare("SELECT * FROM users WHERE id = ?");
									$sql2->bind_param('s', $userID);
									$sql2->execute();
									$result2 = $sql2->get_result();

									while ($row2 = $result2->fetch_assoc())
									{

										$email = $row2['email'];
										$address = $row2['address'];
										$creditcard = $row2['creditCard'];

										?>
										<h4>First Name: <?php echo $firstName?></h4>
										<h4>Last Name: <?php echo $lastName?></h4>
										<h4>Email: <?php echo $email?></h4>
										<h4>Address: <?php echo $address?></h4>
										<h4>Credit Card: <?php echo $creditcard?></h4>
										<hr>

										<?php
									}
								}
						 	}

							else
							{
								?>
								<h2> No groups found with that Group Number. Please try again later </h2>
								<?php
							}

							$delete = $conn->prepare("DELETE FROM groupinfo WHERE gid = ?");
							$delete->bind_param('s', $gid);
							$delete->execute();
							$conn->close();
						?>
						<a href="viewGroups.php">Return to group page.</a></li>
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
