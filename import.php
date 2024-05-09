<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db = "ifoa_bw4";

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

$importFile = 'import.csv';

$fileHandle = fopen($importFile, 'r');

fgetcsv($fileHandle);

$sql = "INSERT INTO wp_users (ID, user_login, user_pass, user_nicename, user_email, user_url, user_registered, user_activation_key, user_status, display_name) VALUES (:valore1, :valore2, :valore3, :valore4, :valore5, :valore6, :valore7, :valore8, :valore9, :valore10)";
$stmt = $pdo->prepare($sql);

while (($row = fgetcsv($fileHandle)) !== false) {
    $valore1 = $row[0];
    $valore2 = $row[1];
    $valore3 = $row[2];
    $valore4 = $row[3];
    $valore5 = $row[4];
    $valore6 = $row[5];
    $valore7 = $row[6];
    $valore8 = $row[7];
    $valore9 = $row[8];
    $valore10 = $row[9];
    $stmt->execute([
        'valore1' => $valore1,
        'valore2' => $valore2,
        'valore3' => $valore3,
        'valore4' => $valore4,
        'valore5' => $valore5,
        'valore6' => $valore6,
        'valore7' => $valore7,
        'valore8' => $valore8,
        'valore9' => $valore9,
        'valore10' => $valore10,
    ]);
}

fclose($fileHandle);
$pdo = null;

echo "Dati importati con successo dal file CSV nel database.";
