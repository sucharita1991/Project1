<?php

//this class is for generating HTML table from a CSV file
class htmlTable{

    public static function genarateTableFromFile($arr){
        $csvTable = '';
        foreach($arr as $row => $innerArray){
            $csvTable .= '';
            foreach($innerArray as $innerRow => $value){
                if($row==0){
                    $csvTable .= '<th>' . $value . '</th>';
                }else {
                    $csvTable .= '<td>' . $value . '</td>';
                }
            }
            $csvTable .= '</tr>';
        }

        return $csvTable;
    }
}
?>