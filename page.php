<?php

abstract class page { //abstract class for defining the backbone of the project
    protected $html;

    public function __construct()
    {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="stylesheet1.css">';
        $this->html .= '<body background="https://www.xmple.com/wallpaper/red-linear-white-gradient-2880x1800-c2-fa8072-ffffff-a-15-f-14.svg">';
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