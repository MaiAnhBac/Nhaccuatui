<?php
$con = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
	$playlistId = $_POST['playlistId'];
	$songId = $_POST['songId'];
	$query = mysqli_query($con, "insert into addplaylist(musicadd,playlistadd) values ('".$songId."','".$playlistId."')");
}
else {
	echo "404 Error!";
}
?>