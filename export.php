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

$sql = "SELECT * FROM wp_users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$csvFile = fopen('output.csv', 'w');
// $csvFile = fopen('output_senza_separatori.csv', 'w');

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($csvFile, $row);
    // fputcsv($csvFile, $row, ' ');
}
fclose($csvFile);
echo "Dati esportati con successo in formato CSV.";

$pdo = null;
