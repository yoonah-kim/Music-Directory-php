<?php

$song = "";
$artist = "";
$genre = "";
$year = "";
$rating = "";
$errorsong = "";
$errorartist = "";
$errorgenre = "";
$erroryear = "";
$errorrating = "";

if (isset($_POST['submit'])) {
	$song = $_POST['song'];
	$artist = $_POST['artist'];
	$genre = $_POST['genre'];
	$year = (int)$_POST['year'];
	$rating = $_POST['rating'];

	if (empty($song)) {
		$errorsong = "<div class='error'><p>Specify a song title</p></div>";
	}
	if (empty($artist)) {
		$errorartist = "<div class='error'><p>Specify an artist</p></div>";
	}
	if (empty($genre)) {
		$errorgenre = "<div class='error'><p>Specify a genre</p></div>";
	}
	if (empty($year)) {
		$erroryear = "<div class='error'><p>Please enter a valid year</p></div>";
	}

	if (empty($rating)) {
		$errorrating = "<div class='error'><p>Give this song a rating</p></div>";
	}
	if ($year >= 2015) {
		$erroryear = "<div class='error'><p>Please enter a valid year</p></div>";

	}
	

	if (isset($_POST['submit'])) {
		$song = strtolower($_POST['song']);
		$artist = strtolower($_POST['artist']);
		$genre = strtolower($_POST['genre']);
		$year = strtolower($_POST['year']);
		$rating = strtolower($_POST['rating']);
		$boolean = FALSE;

		$array = file("data.txt");
		foreach($array as $blah) {

			$delimiter = " | ";
			$input = explode($delimiter, $blah);

			if ((strtolower($input[0]))==(strtolower($song)) && (strtolower($input[1]))==(strtolower($artist))) {
				$boolean = TRUE;
			}
		}
		if ($boolean == TRUE) {
			$errorsong = "<div class='error'><p>This song already exists in your library</p></div>";
		}
	}
	if ( !empty($song) && !empty($artist) && !empty($genre) && !empty($year) && !empty($rating) && $boolean==FALSE) {
		$delimiter = ' | ';
		if (isset ($_POST['submit'])) {
		$file = fopen("data.txt", "a+");

			if (!$file) {
				die("Could not find data.txt file");
			}

			$song = $_POST['song'];
			$artist = $_POST['artist'];
			$genre = $_POST['genre'];
			$year = $_POST['year'];
			$rating = $_POST['rating'];

			fputs($file, "\n$song$delimiter$artist$delimiter$genre$delimiter$year$delimiter$rating");

			fclose($file);
		}

		header('Location: directory.php');
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,400italic%7cSlabo+27px%7cOpen+Sans:300italic,400italic,600italic,400,600,700%7cCourgette' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Music Catalog</title>
</head>
<body>
	<div class="wrapper">
		<div class="navigation">
			<?php include ('php/navigation.php'); ?>
		</div>
		<h1>Add Music</h1>
		<div class="add">
		</div>
		<div class="form">
			<form method="post" action="index.php">
				<label>Song</label>
				<input name="song" type="text" id="song" 
					required title="song title required" value="<?php echo $song ?>"/>
					<?php echo $errorsong; ?><br>
				<label>Artist</label>
				<input name="artist" type="text" id="artist" 
					required title="artist required" value="<?php echo $artist ?>"/><br>
				<div class="row">
					<div class="block">
						<label id="yearlabel">Year</label><br>
						<input name="year" type="text" id="year" required pattern="[0-9]{4}" 
						value="<?php echo $year ?>"/><br>
					</div>
					<div class="block">
						<label>Genre</label><br>
						<select name="genre" id="genre" required title="genre required">
							<option> </option>
							<option>Alternative</option>
							<option>Classical</option>
							<option>Country</option>
							<option>Electronic</option>
							<option>Hip Hop / Rap</option>
							<option>Indie </option>
							<option>Pop</option>
							<option>R and B</option>
							<option>Rock</option>
							<option>Blues</option>
						</select><br>
					</div>
					<div class="block">
						<label>Rating</label><br>
						<select name="rating" id="rating" required title="rating required">
							<option> </option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div>
				<input type="submit" name="submit" class="button" />
			</form>
		</div>
	</div>
</body>
</html>
