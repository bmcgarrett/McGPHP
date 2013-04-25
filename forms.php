<?php include_once('header.php'); ?>
<a href="#mySQLModal" role="button" class="btn" data-toggle="modal">Add Book to MySQL</a>
<a href="#mySQLiteModal" role="button" class="btn" data-toggle="modal">Add Book to SQLite</a>
<div id="mySQLModal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Add Book to MySQL Database</h3>
    </div>
    <div id='newFormDiv' class="modal-body">
        <form id="mySQLForm" action="mySqlTests.php" method="post">
            <span>Book Title: <input type="text" name="bTitle"></span>
            </br>
            <span>Author: <input type="text" name="bAuthor"></span>
            </br>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="javascript:{}" onclick="document.getElementById('mySQLForm').submit();" class="btn btn-primary">Save changes</a>
    </div>
</div>
<div id="mySQLiteModal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Add Book to SQLite Database</h3>
    </div>
    <div id='newFormDiv' class="modal-body">
        <form id="mySQLiteForm" action="sqlite.php" method="post">
            <span>Book Title: <input type="text" name="bTitle"></span>
            </br>
            <span>Author: <input type="text" name="bAuthor"></span>
            </br>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="javascript:{}" onclick="document.getElementById('mySQLiteForm').submit();" class="btn btn-primary">Save changes</a>
    </div>
</div>
<?php include_once('footer.php'); ?>