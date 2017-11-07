<?php

class tableDisplay extends page
{
    public function get()
    {

        if ($_SESSION['validation_message']) { //checking for validation messages inside session variables
            $validMsg = $_SESSION['validation_message'];
        }
        $csvFileType = $_SESSION['csvFileType'];

        $this->html .= "<script type='text/javascript'>alert(\"$validMsg\");</script>"; //alert validation messages

        if ($csvFileType == "csv") { //checking for csv files before converting it into table

            $csvFileName = $_GET['fileName']; //retrieving uploaded file name from header
            $fileToOpen = "Uploads/".$csvFileName;

            $formTable = '<center><h2>HTML Table Generated from CSV file: ' . $csvFileName . '</h2>';
            $formTable .= '<table border="1" cellpadding="2" cellspacing="5">'; //generating table from the file

            $fileArray = fileFunctions::fileRead($fileToOpen); //rreading the file

            $formTable .= htmlTable :: genarateTableFromFile($fileArray); // generating table

            $formTable .= '</table></center>';
            $this->html .= $formTable;


        }else{
            $this->html .="Sorry, you did not upload a CSV file..!!";
        }
    }
}

class fileFunctions{

    public static function fileRead($fileToRead){
        $uploadedFile = fopen($fileToRead, "r");
        while (!feof($uploadedFile)) {
            $fileArray[] = fgetcsv($uploadedFile);
        }
        fclose($uploadedFile);
        return $fileArray;
    }
}
?>

