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

?>