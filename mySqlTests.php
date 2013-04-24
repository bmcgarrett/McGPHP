<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bmcgarr
 * Date: 4/24/13
 * Time: 10:29 AM
 * To change this template use File | Settings | File Templates.
 */

include_once('header.php');

$con = mysqli_connect("us-cdbr-azure-northcentral-a.cleardb.com","b2d6e1092e3131","fd5ca8df","mcgphpmysql");

if (mysqli_connect_errno($con))
{
    echo "Failed to Connect o MySQL: " . mysqli_connect_error();
}

$bTitle = $_POST['bTitle'];
$bAuthor = $_POST['bAuthor'];

mysqli_query($con,"
INSERT INTO books ('title','id','author')
VALUES ($bTitle,3,$bAuthor)
");

$result = mysqli_query($con,"Select * From books");

while ($row = mysqli_fetch_array($result))
{
    echo "Title: " . $row['title'] . "Author: " . $row["author"] . "</br>";
}

mysqli_close($con);

include_once('footer.php');