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

AddBook($bTitle, $bAuthor, $con);

CreateTableFromBooks($con);

CloseMySQLConnection($con);

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
function AddBook($bTitle, $bAuthor, $con)
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

/**
 * @param $con
 */
function CreateTableFromBooks($con)
{
    $result = mysqli_query($con, "Select * From books");

    echo "<h1>MySQL Books Database</h1>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th id='deleteColumnHeading'>Delete</th><th>ID</th><th>Title</th><th>Author</th></tr></thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td><a class='btn btn-danger' href='#'>Delete</a><td>" . $row['id'] . "</td><td>" . $row['title'] . "</td><td>" . $row["author"] . "</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
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
