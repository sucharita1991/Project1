<?php
/**
 * Created by PhpStorm.
 * User: Sucharita
 * Date: 10/11/2017
 * Time: 11:43 PM
 */
class tableDisplay extends page
{

    public function get()
    {
        session_start();
        $errorMsg = $_SESSION['static_message'];
        echo "<script type='text/javascript'>alert(\"$errorMsg\");</script>";
        $csvFileName= $_REQUEST['fileName'];

        //converting csv file to array
        $data=array();
        $uploadedfile = fopen("Uploads/".$csvFileName,"r");
        $formTable = '<table border="1">';
        while(! feof($uploadedfile))
        {
            $data=fgetcsv($uploadedfile);
            $formTable.='<tr>
                <td>'.$data[0].'</td>
                <td>'.$data[1].'</td>
                <td>'.$data[2].'</td>
                <td>'.$data[3].'</td>
                <td>'.$data[4].'</td>
                <td>'.$data[5].'</td>
                </tr>';
        }
        //print_r($data);
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

