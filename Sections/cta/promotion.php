<?
	$sql = "SELECT * FROM `candlestick_admin`.`promotions` where `name`='$extention[0]'";
	if($result = mysqli_query($conn, $sql)){
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result)
?>
	<h2><?print_r($row['title']);?></h2>
	<p><?print_r($row['subtitle']);?>.</p>
	<p><?print_r($row['description']);?></p>
<?
		} else{
			echo "No records matching your query were found.";
		}
	} else{
		echo "ERROR: Could not execute; $sql. " . mysqli_error($conn);
	}
?>