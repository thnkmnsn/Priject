<?php
error_reporting(E_ALL);
header("Content-Type: application/json; charset=utf-8");
include 'dataconnect.php';

$sql = "SELECT id, title, content, author, reference_url, publication_date FROM articles";
$result = mysqli_query($conn, $sql);
$articles = array();

while ($row = mysqli_fetch_assoc($result)) {
    $articles[] = $row;
}

echo json_encode($articles);
mysqli_close($conn);
?>