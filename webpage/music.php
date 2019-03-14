<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">
			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
		<div id="listarea">
			<ul id="musiclist">
			<?php
			function print_size($size){
				if($size>=0&&$size<=1023) 
					echo "(".$size." b)";
				else if($size>=1024&&$size<=1048575){
					$kb = round($size/1024,2);
					echo "(".$kb." kb)";
				}
				else if($size>=1048576){
					$mb = round($size/1048576,2);
					echo "(".$mb." mb)";
				}
			}
			if(isset($_REQUEST["playlist"])){
			$playlist = $_REQUEST["playlist"];
			$list = file("./songs/{$playlist}");
			foreach($list as $music){
				$file_size = filesize("./songs/".trim($music));
			?>
			<li class ="mp3item">
				<a href="<?php echo $music;?>"><?php echo basename($music);?></a>
				<?php
				print_size($file_size);
				?>
			</li>
			<?php }}
			else{
			foreach(glob("./songs/*.mp3") as $filename){
				$file_size = filesize($filename);
			?>
			<li class="mp3item">
				<a href="<?php echo $filename;?>"><?php echo basename($filename);?></a>
				<?php
				print_size($file_size);
				?>
			</li>
			<?php }
			foreach(glob("./songs/*.txt") as $playlist){	
			?>
			<li class="playlistitem"><a href="<?php echo $playlist;?>"><?php echo basename($playlist);?></a></li>
			<?php }}
			?>
			</ul>
		</div>
		<?php
		?>
	</body>
</html>