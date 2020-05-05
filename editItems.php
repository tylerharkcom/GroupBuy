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

				<hr><br>
				<h1><a href="viewItems.php">View Items</a></h1>
				<br><hr>

        <h1>Create Item</h1>
        <div class="border">

          <form class="" action="addItem.php" method="POST">

            <label for="itemName">Item Name</label><br>
            <input type="text" name="name" value="" size="30"><br><br>

            <label for="imageURL">Item Image URL</label><br>
            <input type="text" name="url" value="" size="100"><br><br>

            <button type="submit" name="itemCreate">Submit Item</button>

          </form>

        </div>

        <h1>Delete Item</h1>
        <div class="border">

          <form class="" action="deleteItem.php" method="POST">

            <label for="itemID">Item Name</label><br>
            <input type="text" name="itemName" value="" size="30"><br><br>

            <button type="submit" name="itemDelete">Delete Item</button>

          </form>

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

					<h1>Please log in as an Admin to see this content.</h1>
					<a href="admin.html">Admin Log In</a></li>

        </div>
      </body>
    </html>
  <?php } ?>
