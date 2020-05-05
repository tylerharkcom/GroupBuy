<?php session_start();

unset($_SESSION['userID']);
unset($_SESSION['adminUserID']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['firstName']);
unset($_SESSION['lastName']);

session_destroy();

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

          <h1> You have successfully logged out.</h1>
          <span>Return to <a href="index.php">home page.</a></span>

        </div>
      </div>
  </body>
</html>
