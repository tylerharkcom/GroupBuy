<?php session_start(); ?>

<!-- If the user is logged in, display this content-->
<?php if(isset($_SESSION['username'])) { ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
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
							<li class="active"><a href="adminPage.php">Admin Page</a></li>
							<li><a href="editItems.php">Edit Items</a></li>
							<li><a href="viewGroups.php">View Group</a></li>
							<li><a href="logout.php">Log Out</a></li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="container">

        <h1>Welcome to the Store Management System, <?php echo $_SESSION['username'] ?>.</h1>
				<h3>To add or delete items to the system,
	        <a href="editItems.php">go to the items menu!</a>
	        <br><br>
	        To edit groups,
	        <a href="viewGroups.php">go to the groups menu!</a>
	        <br><br>
	      </h3>
        <span><a href="logout.php">Log Out</a></span>
      </div>
    </body>
  </html>

<!-- If the user is NOT logged in, display this content-->
  <?php } else { ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
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

          <h1>Welcome to the Shopping Application Project for COP 4710.</h1>
          <h3>Please log in and use the links in the navigation bar to access different parts of the system.</h3>
          <span>Don't have an account? <a href="signup.html">Sign up</a></span>
        </div>
      </body>
    </html>
  <?php } ?>
