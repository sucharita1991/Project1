<?php

//this class is for generating HTML table from a CSV file
class htmlTable{

    public static function genarateTableFromFile($data,$countVar){

            if ($countVar == 1) { //checking the first row for generating table heading.
                $csvTable = '<tr>';
                foreach ($data as $values) {
                    $csvTable .= '<th>' . $values . '</th>'; //generating table heading
                }
                $csvTable .= '</tr>';
            } else {    //checking for the rest of the table for generating table body/table data
                $csvTable = '<tr>';
                foreach ($data as $values) {
                    $csvTable .= '<td>' . $values . '</td>'; //generating table heading
                }

                $csvTable .= '</tr>';
            }

        return $csvTable;
    }
}
?>