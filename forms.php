<?php include_once('header.php'); ?>
<div id='content' class='row-fluid'>
    <div id='newFormDiv'>
        <form action="mySqlTests.php" method="post">
            <span>Book Title: <input type="text" name="bTitle"></span>
            </br>
            <span>Author: <input type="text" name="bAuthor"></span>
            </br>
            <input type="submit" value="Add Book">
        </form>
    </div>
</div>
<?php include_once('footer.php'); ?>