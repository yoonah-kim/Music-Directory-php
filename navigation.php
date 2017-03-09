<ul id="navlist">
	<?php 

$url["add"] = "index.php";
$url["directory"] = "directory.php";
$url["search"] = "search.php";

	foreach ( $url as $title => $link) {
		print("<li><a href='$link'>$title</a></li>");
	}
?>
</ul>