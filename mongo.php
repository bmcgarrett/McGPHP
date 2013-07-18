<?php include_once('header.php');

try {

$connection_url = getenv("CUSTOMCONNSTR_mongo");

// create the mongo connection object
$m = new Mongo($connection_url);

// extract the DB name from the connection path
$url = parse_url($connection_url);
$db_name = preg_replace('/\/(.*)/', '$1', $url['path']);

// use the database we connected to
$db = $m->selectDB($db_name);

echo "<h2>Collections</h2>";
echo "<ul>";

// print out list of collections
$cursor = $db->listCollections();
$collection_name = "";
foreach( $cursor as $doc ) {
    echo "<li>" .  $doc->getName() . "</li>";
    $collection_name = $doc->getName();
}
echo "</ul>";

// print out last collection
if ( $collection_name != "" ) {
    $collection = $db->selectCollection($collection_name);
    echo "<h2>Documents in ${collection_name}</h2>";

    // only print out the first 5 docs
    $cursor = $collection->find();
    $cursor->limit(5);
    echo $cursor->count() . ' document(s) found. <br/>';
    foreach( $cursor as $doc ) {
        echo "<pre>";
        var_dump($doc);
        echo "</pre>";
    }
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
?>
include_once('footer.php'); ?>