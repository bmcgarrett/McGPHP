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

    $cursor = $collection->find();

    echo "<h1>Mongo Books Database</h1>";
    echo "<table class='table table-striped table-bordered table-hover'>";
    echo "<thead><tr><th id='deleteColumnHeading'></th><th>ID</th><th>Title</th><th>Author</th><th id='editColumnHeading'></th></tr></thead>";
    echo "<tbody>";

    $bookCount = 1;
    foreach ( $cursor as $doc ){
        echo "<tr rowID='" . $doc['_id'] . "'><td><a id='deleteBookRow' class='btn btn-danger' href='#'>Delete</a><td>" . $bookCount . "</td><td id='bookTitleField'>" . $doc['title'] . "</td><td id='bookAuthorField'>" . $doc["author"] . "</td><td><a id='editBookBtn' data-toggle='modal' role='button' class='btn' href='#editBookModal'>Edit</a></td></tr>";
        $bookCount++;
    }

    echo "</tbody>";
    echo "</table>";
    echo "<a class='btn' href='#addBookModal' data-toggle='modal' role='button'>Add Book</a>";


// disconnect from server
    $m->close();
} catch ( MongoConnectionException $e ) {
    die('Error connecting to MongoDB server');
} catch ( MongoException $e ) {
    die('Mongo Error: ' . $e->getMessage());
} catch ( Exception $e ) {
    die('Error: ' . $e->getMessage());
}

include_once('footer.php'); ?>