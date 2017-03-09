<!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,400italic%7cSlabo+27px%7cOpen+Sans:300italic,400italic,600italic,400,600,700%7cCourgette' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Search Form</title>
</head>
<body>
	<div class="wrapper">
		<div class="navigation">
			<?php include ('php/navigation.php'); ?>
		</div>
		<h1>Search Music</h1>
		<div class="form">
			<form method="post" action="search.php">
				<label>Song</label>
				<input name="song" type="text" id="song" class="search"/>
				<label>Artist</label>
				<input name="artist" type="text" id="artist" class="search"/>
				<div class="row">
					<div class="block">
						<label>Year</label><br>
						<input name="year" type="text" id="year" class="search"/>
					</div>
					<div class="block">
						<label>Genre</label><br>
						<select name="genre" id="genre" title="genre required">
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
						<select name="rating" id="rating" title="rating required">
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
		<div class="searchresult">
			<?php

			if (isset($_POST['submit'])) {
				$song = strtolower($_POST['song']);
				$artist = strtolower($_POST['artist']);
				$genre = strtolower($_POST['genre']);
				$year = strtolower($_POST['year']);
				$rating = strtolower($_POST['rating']);

				$success = FALSE;

				$array = file("data.txt");
				foreach($array as $blah) {

					$delimiter = " | ";
					$input = explode($delimiter, $blah);

					if ((empty($song) || (!empty($song) && (strpos(strtolower($input[0]), $song) !==FALSE)))
						&&(empty($artist) || (!empty($artist) && (strpos(strtolower($input[1]), $artist) !==FALSE)))
						&&(empty($genre) || (!empty($genre) && (strpos(strtolower($input[2]), $genre) !==FALSE)))
						&&(empty($year) || (!empty($year) && (strpos(strtolower($input[3]), $year) !==FALSE)))
						&&(empty($rating) || (!empty($rating) && (strpos(strtolower($input[4]), $rating) !==FALSE)))){

						echo "<div class='whole'>"."<div class='rows'>"."<div class='song_title'>".$input[0]."</div>".
					"<div class='song_artist'>".$input[1]."</div>"."</div>".
					"<div class='song_info'>".$input[2]." <strong>//</strong> ".$input[3].
					" <strong>//</strong> ".$input[4]."stars"."<br><br>"."</div>"."</div>";
					$success = TRUE;
					}
				}
				if ($success == FALSE) {
					echo "<p>Search result does not exist</p>";

				}
			}
			?>
		</div>
	</div>
</body>
</html>