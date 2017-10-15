<?php

class tableDisplay extends page
{
    public function get()
    {
        session_start();
        $errorMsg = $_SESSION['validation_message'];
        echo "<script type='text/javascript'>alert(\"$errorMsg\");</script>";
        $csvFileName= $_GET['fileName'];

        //converting csv file to array
        $data=array();
        $uploadedfile = fopen("Uploads/".$csvFileName,"r");
        $formTable = '<table border="1">';
        $arraylength=0;
        $countVar=0;
        while(! feof($uploadedfile))
        {
            $countVar++;
            $i=0;
            $data=fgetcsv($uploadedfile);
            for($index=0;$index<count($data);$index++){
                if($countVar > 1){
                    break;
                }
                $arraylength++;
            }
            if($countVar == 1){
                $formTable .= '<tr>';
                for($i=0;$i<$arraylength;$i++) {
                    $formTable .= '<th>' . $data[$i] . '</th>';
                }
                $formTable .= '</tr>';
            }else {
                $formTable .= '<tr>';
                for($i=0;$i<$arraylength;$i++) {
                    $formTable .= '<td>' . $data[$i] . '</td>';
                }
                $formTable .= '</tr>';
            }
        }
        $formTable.='</table>';
        fclose($uploadedfile);
        print($formTable);
    }

    public function post()
    {
       // print_r($_POST);
    }
}
?>

