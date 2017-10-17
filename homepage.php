<?php


class homepage extends page {

    public function get()
    {
        $form = '<form method="post" enctype="multipart/form-data"><center>';
        $form .= '<img src="https://web.njit.edu/~bieber/home-images/njit-logo.jpg" height="200" width="400" id="njitLogo"><br><br>';
        $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
        $form .= '<input type="submit" value="Upload File" name="submit">';
        $form .= '</center></form> ';
        $this->html .= '<center><h1>Upload CSV File</h1></center>';
        $this->html .= $form;

    }

    public function post() {
        session_start();
        if(isset($_POST['submit'])) {

            $errorMsg = "";
            $target_dir = "Uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $csvFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $csvFileName = pathinfo($target_file, PATHINFO_BASENAME);
            header('Location: index.php?page=tableDisplay&fileName='.$csvFileName);

            //Validation messages
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
            if ($errorMsg) {
                $_SESSION['validation_message'] = $errorMsg;
            }
        }
    }
}
?>