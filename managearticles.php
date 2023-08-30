<?php
include 'headerAdmin.php';
include 'dataconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ระบบรับแจ้งซ่อมนาิกาบนเว็บไซต์ - Watch Repair Notification System">
    <meta name="author" content="Vasutron Luanglum - วสุทร เลิงลำ">
    <meta name="keywords" content="โครงการ, โปรเจ็คจบ, โครงการ ป.ตรี, Project, โครงการ">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css_managearticles.css">

    <title>Manage Articles</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#repair-requests-table').dataTable(); // เปลี่ยนเป็น .dataTable() แทน .DataTable()
    });
    </script>
    
</head>

<body>
    <?php
        include 'manu_headerAD.php';

        // Function to add article
        function addArticle($conn) 
        {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author = $_POST['author'];
            $reference_url = $_POST['reference_url'];
            $publication_date = $_POST['publication_date'];
        
            $stmt = $conn->prepare("INSERT INTO articles (title, content, author, reference_url, publication_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $title, $content, $author, $reference_url, $publication_date);
            $stmt->execute();
            $stmt->close();
            header("Location: managearticles.php");
            exit();
        }

        // Function to delete article
        function deleteArticle($conn)
        {
            if (isset($_POST['delete_article']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
            }
            header("Location: managearticles.php");
            exit();
        }

        // Function to update article
        function updateArticle($conn)
        {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author = $_POST['author'];
            $reference_url = $_POST['reference_url'];
            $publication_date = $_POST['publication_date'];

            $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, author = ?, reference_url = ?, publication_date = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $title, $content, $author, $reference_url, $publication_date, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: managearticles.php");
            exit();
        }
            
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            if (isset($_POST['add_article'])) {
                addArticle($conn);
            } elseif (isset($_POST['update_article'])) {
                updateArticle($conn);
            } elseif (isset($_POST['delete_article'])) {
                deleteArticle($conn);
            }
        }
        
    ?>
    <main>
    <div class="container">
        <h1 class="text-center mt-5">จัดการบทความ</h1>

        <!-- Add Article Form and Modal-->
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#add-article-modal">เพิ่มบทความใหม่</button>

        <div class="modal" tabindex="-1" id="add-article-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="mb-3">
                                <label for="reference_url" class="form-label">Reference URL</label>
                                <input type="url" class="form-control" id="reference_url" name="reference_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="publication_date" class="form-label">Publication Date</label>
                                <input type="date" class="form-control" id="publication_date" name="publication_date"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_article">Add Article</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display, Search, Update and Delete Articles -->
        <!-- <h3 class="mt-5">Articles</h3> -->
        <br>
        <input class="form-control" id="searchInput" type="text" placeholder="Search.." style="display: none;" />
        <br />
        <table id="repair-requests-table" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>หัวข้อ</th>
                    <th>เนื้อหา</th>
                    <th>ผู้แต่ง</th>
                    <th>URL อ้างอิง</th>
                    <th>วันที่เผยแพร่</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody id="articlesTable">
                <?php
                $sql = "SELECT * FROM articles";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["content"] . "</td>";
                        echo "<td>" . $row["author"] . "</td>";
                        echo "<td>" . substr($row["reference_url"], 0, 20) . "...</td>";
                        echo "<td>" . $row["publication_date"] . "</td>";
                        echo "<td><button class='btn btn-warning btn-sm editBtn' data-id='" . $row["id"] . "'>Edit</button> " . "</td>";
                        echo "<td>";
                        echo "<form method='POST' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' name='delete_article' class='btn btn-danger btn-sm'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Update Article Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" method="post"
                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <input type="hidden" id="updateId" name="id">
                            <div class="mb-3">
                                <label for="updateTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="updateTitle" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateContent" class="form-label">Content</label>
                                <textarea class="form-control" id="updateContent" name="content" rows="3"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="updateAuthor" class="form-label">Author</label>
                                <input type="text" class="form-control" id="updateAuthor" name="author" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateReferenceUrl" class="form-label">Reference URL</label>
                                <input type="url" class="form-control" id="updateReferenceUrl" name="reference_url"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="updatePublicationDate" class="form-label">Publication Date</label>
                                <input type="date" class="form-control" id="updatePublicationDate"
                                    name="publication_date" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" form="updateForm" name="update_article">Update
                            Article</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <br>
    <?php
        include_once 'footerEnd.php';
    ?>
    
    <script>
    // Search articles
    document.getElementById("searchInput").addEventListener("keyup", function() {
        const filter = this.value.toUpperCase();
        const rows = document.getElementById("articlesTable").getElementsByTagName("tr");
        for (let i = 0; i < rows.length; i++) {
            const columns = rows[i].getElementsByTagName("td");
            let showRow = false;
            for (let j = 0; j < columns.length; j++) {
                if (columns[j].textContent.toUpperCase().includes(filter)) {
                    showRow = true;
                    break;
                }
            }
            rows[i].style.display = showRow ? "" : "none";
        }
    });

    // Edit and Delete button click event listeners
    document.querySelectorAll(".editBtn, .deleteBtn").forEach(function(btn) {
        btn.addEventListener("click", function() {
            if (this.classList.contains("editBtn")) {
                // Edit button clicked
                const id = this.getAttribute("data-id");
                const row = this.closest("tr");
                const rowData = row.getElementsByTagName("td");

                // Fill the update form with the current data
                document.getElementById("updateId").value = rowData[0].textContent;
                document.getElementById("updateTitle").value = rowData[1].textContent;
                document.getElementById("updateContent").value = rowData[2].textContent;
                document.getElementById("updateAuthor").value = rowData[3].textContent;
                document.getElementById("updateReferenceUrl").value = rowData[4].textContent;
                document.getElementById("updatePublicationDate").value = rowData[5].textContent;

                // Show the update modal
                const updateModal = new bootstrap.Modal(document.getElementById("updateModal"));
                updateModal.show();
            } else if (this.classList.contains("deleteBtn")) {
                // Delete button clicked
                const confirmDelete = confirm("คุณแน่ใจแล้วใช่ไหม ที่จะลบบทความออก?");
                if (confirmDelete) {
                    const id = this.getAttribute("data-id");
                    const form = document.createElement("form");
                    form.method = "POST";
                    form.action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>";
                    const inputId = document.createElement("input");
                    inputId.type = "hidden";
                    inputId.name = "id";
                    inputId.value = id;
                    form.appendChild(inputId);
                    const inputSubmit = document.createElement("input");
                    inputSubmit.type = "submit";
                    inputSubmit.name = "delete_article";
                    inputSubmit.value = "Delete Article";
                    form.appendChild(inputSubmit);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    // Initialize the DataTables
    $(document).ready(function() {
        $('#repair-requests-table').DataTable();
    });
    </script>
</body>

</html>