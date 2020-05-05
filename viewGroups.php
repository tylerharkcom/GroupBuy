<?php session_start();
function getDiscount($groupCount)
{
	$discount = $groupCount * 0.25 / 7 * 100;

	return min(ceil($discount), 75);
}
?>

<!-- If the user is logged in, display this content-->
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

            <h1> Current Groups</h1>
            <?php
              $conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

							// Get unique group numbers
              $sql = $conn->prepare("SELECT gid FROM groupinfo GROUP BY gid;");
            	$sql->execute();

            	$result = $sql->get_result();

              if ($result->num_rows > 0)
            	{
                while ($row = $result->fetch_assoc())
                {
                  $gid = $row['gid'];

									// Get group info from "groupinfo" table
							    $sql2 = $conn->prepare("SELECT * FROM groupinfo WHERE gid = ?");
							    $sql2->bind_param('s', $gid);
							    $sql2->execute();
							    $result2 = $sql2->get_result();
							    $row2 = $result2->fetch_assoc();
									$pid = $row2['pid'];
									$created = $row2['created'];
									$expires = strtotime($created);
							    $expires = strtotime("+7 day", $expires);

									// Get product info from "items" table
							    $sql3 = $conn->prepare("SELECT * FROM items WHERE pid = ?");
							    $sql3->bind_param('s', $pid);
							    $sql3->execute();
							    $result3 = $sql3->get_result();
							    $row3 = $result3->fetch_assoc();

									$productName = $row3['pName'];
							    $productURL = $row3['url'];

									// Get groupCount from groupinfo table
									$sql4 = $conn->prepare("SELECT COUNT(*) FROM groupinfo WHERE gid = ?");
							    $sql4->bind_param('s', $gid);
							    $sql4->execute();
							    $result4 = $sql4->get_result();
							    $row4 = $result4->fetch_assoc();

							    $groupCount = $row4['COUNT(*)'];

                  ?>
                  <hr>
									<h1>Group #<?php echo $gid ?></h1>
									<h3>Product Name: <?php echo $productName?></h3>
									<?php echo "<img src=\"$productURL\" height='200px' width='300px'>"; ?>
									<br>
									<h4> There are <?php echo $groupCount ?> people in this group. </h4>
									<h4>Current discount: <?php echo getDiscount($groupCount) ?>% off of original price</h4>
									<br>
									<h4> This group expires automatically on <?php echo date("j F Y", $expires)?>.</h4>
									<br>
									<a href=endGroup.php?gid=<?php echo $gid?>><button type="button" class="btn btn-danger">End Group</button></a>

                  <?php
                }
            	}

              else
              {
                ?> <h1>There are no active groups.</h1> <?php
              }

            		$conn->close();
            ?>

            <!-- Insert php for loop, will print out all items when needed -->

          </div>
        </div>
    </body>
  </html>

<!-- If the user is NOT logged in, display this content-->
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
                <li><a href="admin.html">Admin</a></li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="container">
          <div class="border">

						<h1>Please log in as an Admin to see this content.</h1>
						<a href="admin.html">Admin Log In</a></li>

          </div>
        </div>
    </body>
  </html>

<?php } ?>
