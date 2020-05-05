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

	$name = $_POST['name'];
	$url = $_POST['url'];

	$sql = "INSERT INTO items (pName, url) VALUES ('$name', '$url')";

	if ($conn->query($sql) !== TRUE)
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>
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
              <a class="navbar-brand" href="adminPage.php">Shopping Application</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
							<li><a href="adminPage.php">Admin Page</a></li>
							<li class="active"><a href="editItems.php">Edit Items</a></li>
							<li><a href="viewGroups.php">View Group</a></li>
							<li><a href="logout.php">Log Out</a></li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="container">
        <div class="border">

				<h1> Item added successfully!
				<a href="editItems.php">Return to item editing page.</a></li>

        </div>


      </div>
  </body>
</html>
