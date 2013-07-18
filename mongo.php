<?php include_once('header.php');

$conn_str = getenv("CUSTOMCONNSTR_mongo");

$m = new Mongo($conn_str);

$url = parse_url($connection_url);
$db_name = preg_replace('/\/(.*)/', '$1', $url['path']);

$db = $m->selectDB($db_name);

$cursor = $db->listCollections();
$collection_name = "";
echo "<h3>Mongo Collections</h3>";
foreach( $cursor as $doc ) {
    echo "<li>" .  $doc->getName() . "</li>";
    $collection_name = $doc->getName();
}
echo "</ul>";

include_once('footer.php'); ?>