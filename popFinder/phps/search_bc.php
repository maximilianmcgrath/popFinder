<?php 
	// Define Credentials
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


	//Perform SQL Queries
	$sql_countries = "SELECT DISTINCT `Country/Territory` from bigcountries;";
	$sql_continents = "SELECT DISTINCT continent FROM bigcountries;";

	$results_countries = $mysqli->query($sql_countries);
	$results_continents = $mysqli->query($sql_continents);


	if ( $results_countries == false or $results_continents == false) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	//Close connection
	$mysqli->close();

?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Small Countries Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		body{
			background-color: #cdb0d9;
		}
		#globe{
			width: 10%;
			height: auto;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">Search</li>
	</ol>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-2">
				<img src="https://www.freepnglogos.com/uploads/earth-png/planet-earth-png-page-pics-about-space-0.png" id="globe">
			</div>	
		</div>
		<div class="row">
			<h4 class="col-12 mt-2" align="center"><strong>popFinder</strong></h4>
		</div>
		<div class="row">
			<h1 class="col-12 mt-4">Big Countries <strong>popFinder</strong></h1>
			<p class = "col-12 mb-4">Only input Continent OR Country/Territory</p>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<form action="search_results2.php" method="GET">
			<div class="form-group row">
				<label for="continent-id" class="col-sm-3 col-form-label text-sm-right">Continent:</label>
				<div class="col-sm-9">
					<select name="continent_id" id="continent-id" class="form-control">
						<option value="" selected>-- All --</option>

						<?php while ($row = $results_continents->fetch_assoc()): ?>
						
								<option value='<?php echo $row['continent']; ?>'>
									<?php echo $row['continent']; ?>
								</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="country-id" class="col-sm-3 col-form-label text-sm-right">Country/Territory:</label>
				<div class="col-sm-9">
					<select name="country_id" id="country-id" class="form-control">
						<option value="" selected>-- All --</option>

						<?php while ($row = $results_countries->fetch_assoc()): ?>
						
								<option value='<?php echo $row['Country/Territory']; ?>'>
									<?php echo $row['Country/Territory']; ?>
								</option>

						<?php endwhile; ?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label text-sm-right">Year:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check1970" value="1970" checked>1970
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check1980" value="1980">1980
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check1990" value="1990">1990
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check2000" value="2000">2000
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check2010" value="2010">2010
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check2015" value="no">2015
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check2020" value="2020">2020
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="year" id="check2022" value="2022">2022
						</label>
					</div>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label class="col-sm-3 col-form-label text-sm-right">Order:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="order" id="checknone" value=" " checked>None
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="order" id="checkltg" value=" order by Population">Least to Greatest
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="order" id="checkgtl" value=" order by Population desc">Greatest to Least
						</label>
					</div>
				</div>
			</div> 
			<div class="form-group row">
				<label class="col-sm-3 col-form-label text-sm-right">Limit:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="limit" id="checknone" value=" " checked>None
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="limit" id="checkten" value=" limit 10">10
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label my-1">
							<input class="form-check-input mr-2" type="radio" name="limit" id="checktwentyfive" value=" limit 25">25
						</label>
					</div>
				</div>
			</div> 
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>