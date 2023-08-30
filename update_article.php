<?php
include 'dataconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $reference_url = $_POST['reference_url'];
    $publication_date = $_POST['publication_date'];

    // Prepare an UPDATE statement to update the article in the database
    $sql = "UPDATE articles SET title=?, content=?, author=?, reference_url=?, publication_date=? WHERE id=?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "sssssi", $title, $content, $author, $reference_url, $publication_date, $id);

        // Execute the statement and check for errors
        if (mysqli_stmt_execute($stmt)) {
            echo "Article updated successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>