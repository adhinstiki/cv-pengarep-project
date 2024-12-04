<?php
$host = 'o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com'; 
$user = 'cnsbyfdh2qp6sdl2';      
$password = 'qlev2fbx1qt5qmu6';     
$db_name = 'qfhwap8byb54498t'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
