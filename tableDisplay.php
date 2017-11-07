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
            $fileToOpen = "Uploads/".$csvFileName;

            $formTable = '<center><h2>HTML Table Generated from CSV file: ' . $csvFileName . '</h2>';
            $formTable .= '<table border="1" cellpadding="2" cellspacing="5">'; //generating table from the file
            $countVar = 0;

            $uploadedfile = fileFunctions::openFile($fileToOpen);

            while (!feof($uploadedfile)) { //looping through the file till the end of file, one row at a time.

                $countVar++; //variable for determining the row that is being read.

                $fileArray = fileFunctions::fileRead($uploadedfile);

                //generating a HTML Table from the Uploaded file
                $formTable .= htmlTable :: genarateTableFromFile($fileArray,$countVar);
            }
            $formTable .= '</table></center>';

            fileFunctions::closeFile($uploadedfile); //close the opened file
            stringFunctions::printThis($formTable);  //printing table at the end

        }else{
            echo "Sorry, you did not upload a CSV file..!!";
        }
    }
}

class fileFunctions{

    public static function fileRead($fileToRead){
        $fileArray = fgetcsv($fileToRead);
        return $fileArray;
    }
    public static function openFile($fileToOpen){
        $uploadedFile = fopen($fileToOpen, "r");;
        return $uploadedFile;
    }
    public static function closeFile($fileToClose){
        fclose($fileToClose);
    }
}
?>

