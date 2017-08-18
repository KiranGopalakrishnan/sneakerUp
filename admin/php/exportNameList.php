<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 27-03-2017
 * Time: 11:39 AM
 */
require_once 'database.php';
require_once 'class.exporter.php';
$db= new database();
$tickets = $db->getTicketsLessInfo($_GET["id"]);
$dataHeaders= array("Firstname","Lastname","Email");
array_unshift($tickets,$dataHeaders);
$exporter = new exporter();
$exportToexcel = $exporter->toExcel($tickets);