<?php include_once('header.php');

try {

    $connection_url = getenv("CUSTOMCONNSTR_mongo");
    $collection_name = "learn";

    // create the mongo connection object
    $m = new Mongo($connection_url);

    // extract the DB name from the connection path
    $url = parse_url($connection_url);
    $db_name = preg_replace('/\/(.*)/', '$1', $url['path']);

    // use the database we connected to
    $db = $m->selectDB($db_name);

    $collection = $db->selectCollection($collection_name);

    ModifyDB($collection);

    $cursor = $collection->find();

    echo "<h1>Mongo Books Database</h1>";
    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead><tr><th id='deleteColumnHeading'></th><th>ID</th><th>Title</th><th>Author</th><th id='editColumnHeading'></th></tr></thead>";
    echo "<tbody>";

    $bookCount = 1;
    foreach ( $cursor as $doc ){
        echo "<tr rowID='" . $doc['_id'] . "'><td><a id='deleteBookRowMongo' class='btn btn-danger' href='#'>Delete</a><td>" . $bookCount . "</td><td id='bookTitleField'>" . $doc['title'] . "</td><td id='bookAuthorField'>" . $doc["author"] . "</td><td><a id='editBookBtnMongo' data-toggle='modal' role='button' class='btn' href='#editBookModal'>Edit</a></td></tr>";
        $bookCount++;
    }

    echo "</tbody>";
    echo "</table>";
    echo "<a class='btn' href='#addBookModal' data-toggle='modal' role='button'>Add Book</a>";


    // disconnect from server
    $m->close();
}   catch ( MongoConnectionException $e ) {
        die('Error connecting to MongoDB server');
}   catch ( MongoException $e ) {
        die('Mongo Error: ' . $e->getMessage());
}   catch ( Exception $e ) {
        die('Error: ' . $e->getMessage());
}

include_once('footer.php'); ?>

<?php

function ModifyDB($collection){
    if (isset($_POST['bookTitle']) && isset($_POST['bookAuthor'])) {
        $bTitle = $_POST['bookTitle'];
        $bAuthor = $_POST['bookAuthor'];

        $bookToInsert = array(
          'title' => $bTitle,
          'author' => $bAuthor,
        );

        $collection->insert($bookToInsert);
    }

    if (isset($_POST['bookIDToRemove'])){
        $objectToRemove = $_POST['bookIDToRemove'];

        $collection->remove(array('_id' => new MongoId($objectToRemove)),array("safe" => true));
    }

    if (isset($_POST['editTitleNew']) && isset($_POST['editAuthorNew']) && isset($_POST['rowIDToChange'])){
        $editTitleNew = $_POST['editTitleNew'];
        $editAuthorNew = $_POST['editAuthorNew'];
        $objectToChange = $_POST['rowIDToChange'];

        $bookToUpdate = array(
            'title' => $editTitleNew,
            'author' => $editAuthorNew,
        );

        $collection->update(array('_id' => new MongoId($objectToChange)),$bookToUpdate);
    }
}

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
        <a id="saveBtnAddBookMongo" href="#" class="btn btn-primary">Save changes</a>
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
        <a id="saveBtnEditBookMongo" href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>