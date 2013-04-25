<?php
include_once('header.php');

$db = new SQLite3("test.db");

$bookTitle = $_POST['bTitle'];

$bookAuthor = $_POST['bAuthor'];

if (isset($bookTitle) && isset($bookAuthor))
{
    $insertStatement = "INSERT INTO books (TITLE,AUTHOR) VALUES ('$bookTitle','$bookAuthor')";

    $result = $db->query($insertStatement);

    if(!$result)
    {
        die('Book not added');

    }
}

$selBooks = 'SELECT * FROM Books';

$resultAllBooks = $db->query($selBooks);

//$resultArray = $resultAllBooks->fetchArray();

echo "<h1>SQLite Books Database</h1>";
echo "<table class='table table-striped'>";
echo "<thead><tr><th>ID</th><th>Title</th><th>Author</th></tr></thead>";
echo "<tbody>";

while($row = $resultAllBooks->fetchArray(SQLITE3_ASSOC))
{
    echo "<tr><td>".$row["ID"]."</td><td>".$row["TITLE"]."</td><td>".$row["AUTHOR"]."</td></tr>";
}

echo "</tbody>";
echo "</table>";

$db->close();


include_once('footer.php');

