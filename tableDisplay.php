<?php

class tableDisplay extends page
{
    public function get()
    {
        session_start(); //starting the session for retrieving session variables

        if ($_SESSION['validation_message']) { //checking for validation messages inside session variables
            $validMsg = $_SESSION['validation_message'];
        }
        $csvFileType = $_SESSION['csvFileType'];
        echo "<script type='text/javascript'>alert(\"$validMsg\");</script>"; //alert validation messages

        if ($csvFileType == "csv") { //checking for csv files before converting it into table

            $csvFileName = $_GET['fileName']; //retrieving uploaded file name from header
            $formTable="";

            //converting csv file to array
            $data = array();
            $uploadedfile = fopen("Uploads/" . $csvFileName, "r"); //opening the file from the target directory

            //generating a HTML Table from the Uploaded file
            $formTable .= htmlTable :: genarateTableFromFile($uploadedfile,$csvFileName);

            fclose($uploadedfile); //close the opened file
            stringFunctions::printThis($formTable);  //printing table at the end
        }else{
            echo "Sorry, you did not upload a CSV file..!!";
        }
    }
}
?>

