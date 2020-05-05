<?php session_start(); ?>

<!-- If the user is logged in, display this content-->
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

            <h1>Available Items!</h1>
            <h5> To purchase an item, please request a code using the "Get Group Code" button. </h5>

            <?php
              $conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

              $sql = $conn->prepare("SELECT * FROM `items`");
            	$sql->execute();

            	$result = $sql->get_result();

              if ($result->num_rows > 0)
            	{
                while ($row = $result->fetch_assoc())
                {
                  $pid = $row['pid'];
                  $name = $row['pName'];
                  $url = $row['url'];

                  ?>
                  <br>
                  <!-- link for possible details -->
                  <hr>
                  <h4><?php echo $name ?></h4>
                  <a href=joinGroup.php?pid=<?php echo $pid?>><button type="submit" name="button">Get Group Code</button></a>
                  <br>
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
                <li class="active"><a href="items.php">Items</a></li>
                <li><a href="group-page.php">Group</a></li>
                <li><a href="login.html">Login</a></li>
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
