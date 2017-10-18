<?php


class homepage extends page {

    //form to upload a file
    public function get()
    {
        $form = '<form method="post" enctype="multipart/form-data"><center>';
        $form .= '<img src="https://web.njit.edu/~as739/njit.gif" height="200" width="600" id="njitLogo"><br><br>';
        $form .= '<h1>Upload CSV File</h1><input type="file" name="fileToUpload" id="fileToUpload">';
        $form .= '<input class="button" type="submit" value="Upload File" name="submit">';
        $form .= '</center></form> ';
        $this->html .= $form;

    }

    public function post() {
        session_start(); //start session for storing session variables
        if(isset($_POST['submit'])) { //checking if submit button was clicked

            $target_dir = "Uploads/"; //target directort where the .csv file will be uploaded
            $target_file = str_replace(' ', '_', $target_dir . basename($_FILES["fileToUpload"]["name"]));  //replacing the spaces in filename with underscores
            $csvFileType = pathinfo($target_file, PATHINFO_EXTENSION); //getting the type of the file/file extension uploaded
            $csvFileName = pathinfo($target_file, PATHINFO_BASENAME); //getting the name of the file

            header('Location: index.php?page=tableDisplay&fileName='.$csvFileName); //header function to change the url and append the filename to it

            $errorMsg = fileValidation::getValidationMsgs($target_file,$csvFileType); //static function for validation messages

            $_SESSION['csvFileType'] = $csvFileType; //session variable to save the file type/extension for future reference

            if ($errorMsg) {
                $_SESSION['validation_message'] = $errorMsg; //session variable to save the error message to show as an alert.
            }
        }
    }
}

?>