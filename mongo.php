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

foreach ( $cursor as $doc ){
    var_dump($doc);
}


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