<?php

abstract class page { //abstract class for defining the backbone of the project
    protected $html;

    public function __construct()
    {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="styles.css">';
        $this->html .= '<body background="http://uhqwallpapers.com/wp-content/uploads/2017/02/Light-Abstract-Computer-Background.jpg">';
    }
    public function __destruct()
    {
        $this->html .= '</body></html>';
        stringFunctions::printThis($this->html); //string functions are autoloaded for the stringFunctions class
    }

    //defination of the methods in the parent class to be implemented by the child classes
    public function get() {
        echo 'You are inside get method of parent class';
    }

    public function post() {
        echo 'You are inside post method of parent class';
    }
}

?>