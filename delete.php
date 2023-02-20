 <?php
	$connect = mysqli_connect("localhost", "root", "", "test");
	$id=$_POST['id'];

	$sql = "DELETE FROM `item` WHERE item_id=$id";
	if (mysqli_query($connect, $sql)) {
		echo 'Item Data Deleted';
	} 
	else {
		echo 'All Fields are Required';
	}
	mysqli_close($connect);
?>