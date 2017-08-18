<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 06-03-2017
 * Time: 07:38 PM
 */
class exporter{
    function toExcel($recievedData){
        $array = $recievedData;

        header("Content-Disposition: attachment; filename=\"ticketsSold.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($array as $data)
        {
                fputcsv($out, $data,"\t");
        }
        fclose($out);
    }
}