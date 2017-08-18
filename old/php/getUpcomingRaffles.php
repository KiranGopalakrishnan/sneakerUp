 <?php
 include '../admin/php/database.php';
date_default_timezone_set('America/Toronto');
$db = new database();
// var_dump($_POST);
 //var_dump($_FILES);
$createNew = $db->getUpcomingRaffles();
echo json_encode($createNew);
?>