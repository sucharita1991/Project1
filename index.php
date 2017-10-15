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

//instantiate the program object
$obj = new main();

class main {

    public function __construct()
    {
        $requestPageType = 'homepage';
        if(isset($_REQUEST['page'])) {
            $requestPageType = $_REQUEST['page'];
        }
        $page = new $requestPageType;

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $page->get();
        } else {
            $page->post();
        }
    }

}

abstract class page {
    protected $html;

    public function __construct()
    {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="styles.css">';
        $this->html .= '<body>';
    }
    public function __destruct()
    {
        $this->html .= '</body></html>';
        stringFunctions::printThis($this->html);
    }

    public function get() {
        echo 'default get message';
    }

    public function post() {
        print_r($_POST);
    }
}

class homepage extends page {

    public function get()
    {
        $form = '<form method="post" enctype="multipart/form-data">';
        $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
        $form .= '<input type="submit" value="Upload File" name="submit">';
        $form .= '</form> ';
        $this->html .= '<h1>Upload CSV File 1</h1>';
        $this->html .= $form;

    }

    public function post() {
        session_start();
        if(isset($_POST['submit'])) {

            //print_r($_FILES);
            $errorMsg = "";
            $target_dir = "Uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            //echo $_FILES["fileToUpload"]["name"];
            $uploadOk = 1;
            $csvFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $csvFileName = pathinfo($target_file, PATHINFO_BASENAME);
            //echo $csvFileName;

            //converting csv file to array
            /*$uploadedfile = fopen("Uploads/".$csvFileName,"r");

            while(! feof($uploadedfile))
            {
                print_r(fgetcsv($uploadedfile));
            }

            fclose($uploadedfile);*/

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
                //echo "<script type='text/javascript'>alert(\"$errorMsg\");</script>";
                $_SESSION['static_message'] = $errorMsg;
                header('Location: index.php?page=tableDisplay&fileName='.$csvFileName);
            }

        }
    }

}


class stringFunctions {
    static public function printThis($inputText) {
        return print($inputText);
    }
    static public function stringLength($text) {
        return strLen($text);
    }
}


?>