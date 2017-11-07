<?php

//this class is for generating HTML table from a CSV file
class htmlTable{

    public static function genarateTableFromFile($data,$countVar){

            $i = 0;
            $arraylength = count($data); //counting the number of columns that the table have/ array length
            if ($countVar == 1) { //checking the first row for generating table heading.
                $csvTable = '<tr>';
                for ($i = 0; $i < $arraylength; $i++) {
                    $csvTable .= '<th>' . $data[$i] . '</th>'; //generating table heading
                }
                $csvTable .= '</tr>';
            } else {    //checking for the rest of the table for generating table body/table data
                $csvTable = '<tr>';
                for ($i = 0; $i < $arraylength; $i++) {
                    $csvTable .= '<td>' . $data[$i] . '</td>'; //generating table data/rows
                }
                $csvTable .= '</tr>';
            }

        return $csvTable;
    }
}
?>