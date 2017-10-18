<?php

//this class is for generating HTML table from a CSV file
class htmlTable{

    public static function genarateTableFromFile($uploadedfile,$csvFileName){
        $formTable = '<center><h2>HTML Table Generated from CSV file: ' . $csvFileName . '</h2>';
        $formTable .= '<table border="1">'; //generating table from the file
        $arraylength = 0;
        $countVar = 0;
        while (!feof($uploadedfile)) { //looping through the file till the end of file, one row at a time.
            $countVar++; //variable for determining the row that is being read.
            $i = 0;
            $data = fgetcsv($uploadedfile); //converting each line of the file to an array
            $arraylength = count($data); //counting the number of columns that the table have/ array length
            if ($countVar == 1) { //checking the first row for generating table heading.
                $formTable .= '<tr>';
                for ($i = 0; $i < $arraylength; $i++) {
                    $formTable .= '<th>' . $data[$i] . '</th>'; //generating table heading
                }
                $formTable .= '</tr>';
            } else {    //checking for the rest of the table for generating table body/table data
                $formTable .= '<tr>';
                for ($i = 0; $i < $arraylength; $i++) {
                    $formTable .= '<td>' . $data[$i] . '</td>'; //generating table data/rows
                }
                $formTable .= '</tr>';
            }
        }
        $formTable .= '</table></center>';

        return $formTable;
    }

}
?>