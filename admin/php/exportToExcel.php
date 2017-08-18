<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 06-03-2017
 * Time: 07:36 PM
 */
require_once 'database.php';
require_once 'class.exporter.php';
$db= new database();
$tickets = $db->getTickets($_GET["id"]);
$dataHeaders= array("Ticket Number","RaffleID","ShoeSize","Firstname","Lastname","Email","Purchase Time");
array_unshift($tickets,$dataHeaders);
$exporter = new exporter();
$exportToexcel = $exporter->toExcel($tickets);
