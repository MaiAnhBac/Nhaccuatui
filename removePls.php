<?php
$con = mysqli_connect("localhost", "root", "", "demoweb") or die("Không kết nối được");
if(isset($_POST['playlistId'])&&isset($_POST['songId'])){
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];
    
    $songsQuery = mysqli_query($con, "DELETE FROM addplaylist WHERE playlistadd ='$playlistId' AND musicadd ='$songId'" );
}
else{
    echo "404 Error!";
}
?>