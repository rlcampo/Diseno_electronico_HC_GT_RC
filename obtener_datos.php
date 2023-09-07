<?php
$servername = "database-1.cvdwcehcq5em.us-east-2.rds.amazonaws.com";
$username = "Buabs";
$password = "buabs123";
$dbname = "BuabsBD";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT LONGITUD, LATITUD, FECHA, HORA FROM tabla ORDER BY FECHA DESC, HORA DESC";
$result = $conn->query($sql);

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = array(
        "longitud" => $row["LONGITUD"],
        "latitud" => $row["LATITUD"],
        "fecha" => $row["FECHA"],
        "hora" => $row["HORA"]
    );
}

$data = array_slice($data, 0, 10); // Get the last 10 values

$conn->close();

header("Content-Type: application/json");
echo json_encode($data);
?>