<?php
error_reporting(E_ALL);
header("Content-Type: application/json; charset=utf-8");
include 'dataconnect.php';



if (isset($_POST['id'])) {
    $articleId = $_POST['id'];

    $sql = "SELECT id, title, content, author, reference_url, publication_date FROM articles WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $articleId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Article not found"]);
    }
    
    mysqli_close($conn);
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>