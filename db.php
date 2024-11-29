<?php
// db.php
$db_url = getenv('mysql://cnsbyfdh2qp6sdl2:qlev2fbx1qt5qmu6@o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/qfhwap8byb54498t'); 
$db_parts = parse_url($db_url);

$host = $db_parts['host'];
$user = $db_parts['user'];
$password = $db_parts['pass'];
$db_name = ltrim($db_parts['path'], '/');

$conn = new mysqli($host, $user, $password, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
