<?php
	session_start();

	function generateGroupID($length = 5)
	{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

	$existingGroup = false;
	$alreadyInGroup = false;

	// Get product id from GET request and user info from session
	$pid = $_GET['pid'];
	$userID = $_SESSION['userID'];
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];

	$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

	$check = $conn->prepare("SELECT * FROM groupinfo WHERE userid = ?");
	$check->bind_param('s', $userID);
	$check->execute();

	$result = $check->get_result();

	// User is not in any other groups already
	if ($result->num_rows == 0)
	{
		$check2 = $conn->prepare("SELECT * FROM groupinfo WHERE pid = ?");
		$check2->bind_param('s', $pid);
		$check2->execute();

		$result2 = $check2->get_result();

		// There's a group for this product already
		if ($result2->num_rows > 0)
		{
			$existingGroup = true;
			// Get existing group info
			$row = $result2->fetch_assoc();
			$gid = $row['gid'];
			$created = $row['created'];
			$expires = strtotime($created);
	    $expires = strtotime("+7 day", $expires);
		}

		// There's not a group for this product already
		else
		{
			$gid = generateGroupID();
			$created = date("Y-m-d");
			$expires = strtotime($created);
	    $expires = strtotime("+7 day", $expires);
		}

		$sql = "INSERT INTO groupinfo (gid, pid, userid, firstName, lastName, created) VALUES ('$gid', '$pid', '$userID', '$firstName', '$lastName', '$created')";

		if ($conn->query($sql) !== TRUE)
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	// User is in a group already
	else
	{
		$alreadyInGroup = true;
	}


	$conn->close();
?>

<?php if($alreadyInGroup) { ?>
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

						<h1>You are already in a group!</h1>
						<h5>Users may only be in one group at a time. </h5>
						<a href="items.php">Return to items page.</a></li>

					</div>
				</div>
		</body>
	</html>

<?php } elseif ($existingGroup) { ?>
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

						<h1>Success! You were added to Group #<?php echo $gid ?>.</h1>
						<h5>Your code will expire on <?php echo date("j F Y", $expires) ?>. </h5>
						<a href="items.php">Return to items page.</a></li>


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

            <h1>Success! Group #<?php echo $gid ?> was created.</h1>
            <h5>Your code will expire on <?php echo date("j F Y", $expires) ?>. </h5>
						<a href="items.php">Return to items page.</a></li>

          </div>
        </div>
    </body>
  </html>

<?php } ?>
