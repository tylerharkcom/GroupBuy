<?php session_start(); ?>

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
								<li class="active"><a href="editItems.php">Edit Items</a></li>
								<li><a href="viewGroups.php">View Group</a></li>
								<li><a href="logout.php">Log Out</a></li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="container">
          <div class="border">

            <h1> Current Items</h1>
            <a href="editItems.php">Return to item editing page.</a></li>

            <?php
              $conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

              $sql = $conn->prepare("SELECT * FROM `items`");
            	$sql->execute();

            	$result = $sql->get_result();

              if ($result->num_rows > 0)
            	{
                while ($row = $result->fetch_assoc())
                {
                  $name = $row['pName'];
                  $url = $row['url'];

                  ?>
                  <br>
                  <!-- link for possible details -->
                  <hr>
                  <p><?php echo $name ?></p>
                  <hr>
                  <?php
                  echo "<img src=\"$url\" height='200px' width='300px'>";
                }
            	}

              else
              {
                ?> No items found. Please try again later. <?php
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
