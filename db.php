<?php
$host = '34.128.85.1'; 
$user = 'root';      
$password = 'adhi1234';     
$db_name = 'db_cvpengarep'; 
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:dbname=$dbname;unix_socket=$host", $user, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
