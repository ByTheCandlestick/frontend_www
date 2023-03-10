<?
	$users = array();
	$query = DB_QUERY(sprintf("SELECT `ID`, CONCAT(`First_name`, ' ', `Last_name`) as 'Name' FROM `User accounts`"));
	if($query) {
		while($row = mysqli_fetch_assoc($query)){
			$users += [$row['ID'] => $row['Name']];
		}
	}
	$query = DB_QUERY(sprintf("SELECT * FROM `Audit trail` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_assoc($query)
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-9">
			<h1>Log #<?=$row['ID']?></h1>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">


		<div class="col-12">
			<h5>Taxonomy</h5>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($row['string'])?>" disabled>
					<label for="floatingInput">Goods price</label>
				</div>
			</div>
		</div>
	</div>
</section>
<?
	}
?>