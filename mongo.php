<?php include_once('header.php');

$conn_str = getenv("CUSTOMCONNSTR_mongo");

$m = new Mongo($conn_str);

$db = $m->selectDB("bmacusers");

$cursor = $db->listCollections();
$collection_name = "";
echo "<h3>MongoHQ Collections</h3>";
foreach( $cursor as $doc ) {
    echo "<li>" .  $doc->getName() . "</li>";
    $collection_name = $doc->getName();
}
echo "</ul>";

include_once('footer.php'); ?>