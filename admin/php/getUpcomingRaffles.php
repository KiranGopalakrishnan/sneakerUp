 <?php
 include 'database.php';
date_default_timezone_set('America/Toronto');
$db = new database();
$createNew = $db->getUpcomingAndCurrentRaffles();
echo json_encode($createNew);
?>