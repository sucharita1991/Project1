<?php

//this class is for file validation messages
class fileValidation{

    public static function getValidationMsgs($target_file,$csvFileType){

        $errorMsg="";
        $uploadOk = 1; //counter to check if the upload was successful or not.

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
        return $errorMsg;
    }
}

?>