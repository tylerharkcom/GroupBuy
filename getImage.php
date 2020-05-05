<?php
	header("Content-Type: image/png");
	$id = $_GET['id'];

	// do some validation here to ensure id is safe

	$conn = new mysqli("127.0.0.1", "root", "newpassword", "cop4710");
	$sql = $conn->prepare("SELECT * FROM `items` where pid = ?");
	$sql->bind_param('i', $id);
	$sql->execute();
	$result = $sql->get_result();

	while($row = $result->fetch_assoc())
	{
		?>
  	<img name="<?php echo $row['pid'] ?>" src="<?php $row['url'] ?>" /> <br />
		<?php
	}

	echo 'Total results: ' . $result->num_rows;
	// $row = $result->fetch_assoc();
	//
	// $img = $row['url'];
	//
	// $conn->close();
	//
	// echo '<img src="'.$img.'" alt="HTML5 Icon" style="width:128px;height:128px">';

	// header("Content-type: image/jpeg");

	// echo $row['url'];
?>
