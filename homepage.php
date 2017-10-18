<?php


class homepage extends page {

    public function get()
    {
        $form = '<form method="post" enctype="multipart/form-data"><center>';
        $form .= '<img src="https://web.njit.edu/~bieber/home-images/njit-logo.jpg" height="200" width="400" id="njitLogo"><h1>New Jersey Institute of Technology</h1><br><br>';
        $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
        $form .= '<input type="submit" value="Upload File" name="submit">';
        $form .= '</center></form> ';
        $this->html .= '<center><h1>Upload CSV File</h1></center>';
        $this->html .= $form;

    }

    public function post() {
        session_start(); //start session for storing session variables
        if(isset($_POST['submit'])) { //checking if submit button was clicked

            $errorMsg = "";
            $target_dir = "Uploads/"; //target directort where the .csv file will be uploaded
            $target_file = str_replace(' ', '_', $target_dir . basename($_FILES["fileToUpload"]["name"]));  //replacing the spaces in filename with underscores
            $csvFileType = pathinfo($target_file, PATHINFO_EXTENSION); //getting the type of the file/file extension uploaded
            $csvFileName = pathinfo($target_file, PATHINFO_BASENAME); //getting the name of the file
            header('Location: index.php?page=tableDisplay&fileName='.$csvFileName); //header function to change the url and append the filename to it

            $errorMsg = fileValidation::getValidationMsgs($target_file,$errorMsg,$csvFileType); //function for validation messages

            if ($errorMsg) {
                $_SESSION['validation_message'] = $errorMsg;
            }
        }
    }
}

?>