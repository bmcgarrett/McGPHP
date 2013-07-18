<?php include_once('header.php'); ?>

<?php

$conn_str = getenv("CUSTOMCONNSTR_mongo");

$m = new Mongo($conn_str);

$url = parse_url($connection_url);
$db_name = preg_replace('/\/(.*)/', '$1', $url['path']);

$db = $m->selectDB($db_name);

$cursor = $db->listCollections();
$collection_name = "";
foreach( $cursor as $doc ) {
    echo "<li>" .  $doc->getName() . "</li>";
    $collection_name = $doc->getName();
}
echo "</ul>";

?>



<?php include_once('footer.php'); ?>