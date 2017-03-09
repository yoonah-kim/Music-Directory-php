<!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,400italic%7cSlabo+27px%7cOpen+Sans:300italic,400italic,600italic,400,600,700%7cCourgette' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<title>Directory</title>
</head>
<body>
	<div class="wrapper">
		<div class="navigation">
			<?php include ('php/navigation.php'); ?>
		</div>
		<h1>Directory</h1>
		<div class="all">
			<?php
			$delimiter = ' | ';
			$file_pointer = fopen('data.txt', 'r');
			if (!$file_pointer) {print('error'); exit;}
			$songs = array();
			while (!feof($file_pointer)) {
				$lines = fgets($file_pointer);
				$song = explode($delimiter, $lines);
				$songs[] = $song;
			}

			foreach ($songs as $lines => $song) {
				echo "<div class='rows'>"."<div class='song_title'>".$song[0]."</div>".
					"<div class='song_artist'>".$song[1]."</div>"."</div>".
					"<div class='song_info'>".$song[2]." <strong>//</strong> ".$song[3]." <strong>//</strong> ".$song[4]."stars"."<br><br>"."</div>";
			}
			fclose($file_pointer);
			?>
		</div>
	</div>

</body>
</html>