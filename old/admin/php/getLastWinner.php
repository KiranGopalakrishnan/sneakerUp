 <?php
 include 'database.php';
date_default_timezone_set('America/Toronto');
$db = new database();
$createNew = $db->getPreviousWinners();
echo json_encode($createNew[count($createNew)-1]);
?>