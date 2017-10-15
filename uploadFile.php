<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//Class to load classes it finds the file when the progrm starts to fail for calling a missing class
class Manage {
    public static function autoload($class) {
        //you can put any file name or directory here
        include $class . '.php';
    }
}

spl_autoload_register(array('Manage', 'autoload'));

$fileUploadObject = new fileUploadMsg();


class fileUploadMsg
{
    public function __construct()
    {
        global $errorMsg;
        $target_dir = "Uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $csvFileType = pathinfo($target_file, PATHINFO_EXTENSION);

// Check if file already exists
        if (file_exists($target_file)) {
            $errorMsg .= "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $errorMsg .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($csvFileType != "csv") {
            $errorMsg .= "Sorry, only CSV files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $errorMsg .= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $errorMsg .= "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                $errorMsg .= "Sorry, there was an error uploading your file.";
            }
        }
    }
    public function __destruct()
    {
        global $errorMsg;
        if ($errorMsg) {
            echo "<script type='text/javascript'>alert(\"$errorMsg\");</script>";
        }
    }

}

?>