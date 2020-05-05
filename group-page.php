<?php
  session_start();

  function getDiscount($groupCount)
	{
    $discount = $groupCount * 0.25 / 7 * 100;

    return min(ceil($discount), 75);
	}

  $alreadyInGroup = false;

  // Get user info from session
	$userID = $_SESSION['userID'];
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];

  $conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");

  $check = $conn->prepare("SELECT * FROM groupinfo WHERE userid = ?");
  $check->bind_param('s', $userID);
  $check->execute();

  $result = $check->get_result();

  // User is in a group already
  if ($result->num_rows > 0)
  {
    $alreadyInGroup = true;
    $row = $result->fetch_assoc();
    $gid = $row['gid'];
    $pid = $row['pid'];
    $created = $row['created'];
    $expires = strtotime($created);
    $expires = strtotime("+7 day", $expires);

    // Get product info from "items" table
    $sql = $conn->prepare("SELECT * FROM items WHERE pid = ?");
    $sql->bind_param('s', $pid);
    $sql->execute();
    $result2 = $sql->get_result();
    $row2 = $result2->fetch_assoc();

    $productName = $row2['pName'];
    $productURL = $row2['url'];

    // Get additional group info from "groupinfo" table
    $sql2 = $conn->prepare("SELECT COUNT(*) FROM groupinfo WHERE gid = ?");
    $sql2->bind_param('s', $gid);
    $sql2->execute();
    $result3 = $sql2->get_result();
    $row3 = $result3->fetch_assoc();

    $groupCount = $row3['COUNT(*)'];

  }

  // else
  // {
  //   $alreadyInGroup = false;
  // }

?>

<!-- If the user is logged in, display this content -->
<?php if(isset($_SESSION['firstName']) && $alreadyInGroup) { ?>
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
                <li ><a href="index.php">Home</a></li>
                <li><a href="items.php">Items</a></li>
                <li class="active"><a href="group-page.php">Group</a></li>
                <li><a href="logout.php">Log Out</a></li>
                <li><a href="admin.html">Admin</a></li>
              </ul>
            </div>
          </nav>
        </header>
        <div class="container">
        <div class="circle-container">
          <div class="circle-text">
            <h1>Group Number</h1>
            <h3>#<?php echo $gid ?></h3>
          </div><br>
        </div>
        <br>
        <div class="border">
          <h1>Product Name: <?php echo $productName ?></h1>
          <?php echo "<img src=\"$productURL\" height='200px' width='300px'>"; ?>
          <br>
          <h1>Number of people in Group #<?php echo $gid ?>: <?php echo $groupCount ?> </h1>
          <br>
          <h1>Current discount: <?php echo getDiscount($groupCount) ?>% off of original price</h1>
          <h4>As more people join your group, your discount will increase!</h4>
          <br>
          <h1>Code expires on: <?php echo date("j F Y", $expires)?></h1>
          <h4> When your code expires, your order info will be forwarded to Amazon and your card will be charged.</h4>
          <br>
          <a href=leaveGroup.php?gid=<?php echo $gid?>><button type="button" class="btn btn-danger">Leave Group</button></a>
        </div>
      </div>
    </body>
  </html>

<!-- If user is logged in but not already in a group... -->
<?php } elseif (isset($_SESSION['firstName'])) { ?>
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
                  <li ><a href="index.php">Home</a></li>
                  <li><a href="items.php">Items</a></li>
                  <li class="active"><a href="group-page.php">Group</a></li>
                  <li><a href="logout.php">Log Out</a></li>
                  <li><a href="admin.html">Admin</a></li>
                </ul>
              </div>
            </nav>
          </header>
          <div class="container">
          <br>
          <div class="border">
            <h1>You are not currently in a group!</h1>
            <p>To join a group, visit the <a href="items.php">items</a> page.</p>
          </div>
        </div>
      </body>
    </html>

<!-- User is NOT logged in -->
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
                <li class="active"><a href="group-page.php">Group</a></li>
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
