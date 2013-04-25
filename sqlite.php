<?php
include_once('header.php');

$db = OpenSQLiteConnection();

AddBook($db);

CreateBooksTable($db);

CloseSQLiteConnection($db);

include_once('footer.php');

/**
 * @param $db
 */
function AddBook($db)
{
    if (isset($_POST['bTitle']) && isset($_POST['bAuthor'])) {
        $bookTitle = $_POST['bTitle'];
        $bookAuthor = $_POST['bAuthor'];

        $insertStatement = "INSERT INTO books (TITLE,AUTHOR) VALUES ('$bookTitle','$bookAuthor')";

        $result = $db->query($insertStatement);

        if (!$result) {
            die('Book not added');

        }
    }
}

/**
 * @param $db
 */
function CreateBooksTable($db)
{
    $selBooks = 'SELECT * FROM Books';

    $resultAllBooks = $db->query($selBooks);

    echo "<h1>SQLite Books Database</h1>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>ID</th><th>Title</th><th>Author</th></tr></thead>";
    echo "<tbody>";

    while ($row = $resultAllBooks->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["TITLE"] . "</td><td>" . $row["AUTHOR"] . "</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

/**
 * @return SQLite3
 */
function OpenSQLiteConnection()
{
    $db = new SQLite3("test.db");
    return $db;
}

/**
 * @param $db
 */
function CloseSQLiteConnection($db)
{
    $db->close();
}

