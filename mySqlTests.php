<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bmcgarr
 * Date: 4/24/13
 * Time: 10:29 AM
 * To change this template use File | Settings | File Templates.
 */
include_once('header.php');
include_once('log4php/logger.php');

$conn_str = getenv("MYSQLCONNSTR_mcgphpMySQL");

$myConnectionArray = connStrToArray($conn_str);

$con = ConnectToMySQL($myConnectionArray);

AddBook($con);

DeleteBook($con);

EditBook($con);

CreateTableFromBooks($con);

CloseMySQLConnection($con);

?>

<div id="addBookModal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Add Book</h3>
    </div>
    <div class="modal-body">
        <h4>Book Title</h4>
        <input id="bookTitleInput" type="textfield">
        <h4>Author</h4>
        <input id="bookAuthorInput" type="textfield">
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a id="saveBtnAddBook" href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>
<div id="editBookModal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Edit Book</h3>
    </div>
    <div class="modal-body">
        <h4>Book Title</h4>
        <input id="bookTitleInputEdit" type="textfield">
        <h4>Author</h4>
        <input id="bookAuthorInputEdit" type="textfield">
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a id="saveBtnEditBook" href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<?php

include_once('footer.php');



/**
 * @return mysqli
 */
function ConnectToMySQL($myConnectionArray)
{
    $con = mysqli_connect($myConnectionArray['Data Source'],$myConnectionArray['User Id'],$myConnectionArray['Password'],$myConnectionArray['Database']);

    if (mysqli_connect_errno($con)) {
        echo "Failed to Connect o MySQL: " . mysqli_connect_error();
       
        return $con;
    }

    return $con;
}

/**
 * @param $bTitle
 * @param $bAuthor
 * @param $con
 */
function AddBook($con)
{
    if (isset($_POST['bTitle']) || isset($_POST['bAuthor'])) {
        $bTitle = $_POST['bTitle'];
        $bAuthor = $_POST['bAuthor'];

        $sqlInsert = "INSERT INTO books (title,author) VALUES ('$bTitle','$bAuthor')";

        if (!mysqli_query($con, $sqlInsert)) {
            die('Error: ' . mysql_error());
        }
    }
}


function DeleteBook($con)
{
    if (isset($_POST['removeTitle']) || isset($_POST['removeAuthor'])) {
        $removeTitle = $_POST['removeTitle'];
        $removeAuthor = $_POST['removeAuthor'];

        $sqlDelete = "DELETE FROM books WHERE title = '$removeTitle' AND author = '$removeAuthor'";

        if (!mysqli_query($con, $sqlDelete)) {
            die('Error: ' . mysql_error());
        }
    }
}

function EditBook($con)
{
    echo '<script type="text/javascript"> alert("' . print_r($_POST) . '");</script>';
    if ( isset($_POST['editTitleNew']) ) {
        echo "<h3>insde function</h3>";
        $editTitleOld = $_POST['editTitleOld'];
        $editTitleNew = $_POST['editTitleNew'];
        $editAuthorOld = $_POST['editAuthorOld'];
        $editAuthorNew = $_POST['editAuthorNew'];
        echo "<h1>" . $editTitleOld . $editTitleNew . $editAuthorOld . $editAuthorNew ."</h1>";

        $sqlUpdate = "UPDATE books SET title = '$editTitleNew',author = '$editAuthorNew' WHERE title = '$editTitleOld',author = '$editAuthorOld'";

        if (!mysqli_query($con, $sqlUpdate)) {
            die('Error: ' . mysql_error());
        }
    }
}

/**
 * @param $con
 */
function CreateTableFromBooks($con)
{
    $result = mysqli_query($con, "Select * From books");

    echo "<h1>MySQL Books Database</h1>";
    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead><tr><th id='deleteColumnHeading'></th><th>ID</th><th>Title</th><th>Author</th><th id='editColumnHeading'></th></tr></thead>";
    echo "<tbody>";

    $bookCount = 0;
    while ($row = mysqli_fetch_array($result)) {
        $bookCount++;
        echo "<tr><td><a id='deleteBookRow' class='btn btn-danger' href='#'>Delete</a><td>" . $bookCount . "</td><td id='bookTitleField'>" . $row['title'] . "</td><td id='bookAuthorField'>" . $row["author"] . "</td><td><a id='editBookBtn' data-toggle='modal' role='button' class='btn' href='#editBookModal'>Edit</a></td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "<a class='btn' href='#addBookModal' data-toggle='modal' role='button'>Add Book</a>";
}

/**
 * @param $con
 */
function CloseMySQLConnection($con)
{
    mysqli_close($con);
}

function connStrToArray($conn_str){
 
    // Initialize array.
    $conn_array = array();
 
    // Split conn string on semicolons. Results in array of "parts".
    $parts = explode(";", $conn_str);
 
 
    // Loop through array of parts. (Each part is a string.)
    foreach($parts as $part){
 
        // Separate each string on equals sign. Results in array of 2 items.
        $temp = explode("=", $part);
 
        // Make items key=>value pairs in returned array.
        $conn_array[$temp[0]] = $temp[1];
    }
 
    return $conn_array;
}
