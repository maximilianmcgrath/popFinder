<?php
	$host = "303.itpwebdev.com";
	$user = "maxmcgra_db_user";
	$pass = "uscitp2022";
	$db = "maxmcgra_big_countries_db";


	//Establish DB connection using PhP MySQLi extension
	$mysqli = new mysqli($host,$user,$pass,$db); 

	//Check for mySQL connection errors
	if ($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');


	// Perform SQL queries
	$sql = "SELECT `Country/Territory`, Capital, Continent,";

	 //2022Pop, 2020Pop, 2015Pop, 2010Pop,2000Pop,1990Pop,1970Pop 
			


	if(isset($_GET['year']) && !empty($_GET['year'])){
		$year = $_GET['year'];
		$sql = $sql . $year . "Pop as Population";
	}

	$sql = $sql . " FROM bigcountries WHERE 1 = 1";


	if(isset($_GET['continent_id']) && !empty($_GET['continent_id'])){
		$continent_id = $_GET['continent_id'];
		$sql = $sql . " AND Continent LIKE '%$continent_id%'";
	}

	if(isset($_GET['country_id']) && !empty($_GET['country_id'])){
		$country_id = $_GET['country_id'];
		$sql = $sql . " AND `Country/Territory` LIKE '%$country_id%'";
	}

	if(isset($_GET['order']) && !empty($_GET['order'])){
		$order = $_GET['order'];
		$sql = $sql . $order;
	}
	if(isset($_GET['limit']) && !empty($_GET['limit'])){
		$limit = $_GET['limit'];
		$sql = $sql . $limit;
	}


	$sql = $sql . ";";

	$results = $mysqli->query($sql);



	if(!$results) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}



	//CLOSE CONNECTION (don't forget!)
	$mysqli->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		body{
			background-color: #cdb0d9;
		}
	</style>
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_sc.php">Search</a></li>
		<li class="breadcrumb-item active">Search Results</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Population Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<div class="row">
			<div class="col-12">

				Showing <?php echo $results->num_rows;?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Country</th>
							<th>Capital</th>
							<th>Continent</th>
							<th><?php echo $year;?></th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results->fetch_assoc() ):?>
							<tr>
								
								<td><?php echo $row['Country/Territory'];?></td>
								<td><?php echo $row['Capital'];?></td>
								<td><?php echo $row['Continent'];?></td>
								<td><?php echo $row['Population'];?></td>

							</tr>
						<?php endwhile;?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_bc.php" role="button" class="btn btn-outline-dark">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>