<?php

abstract class page {
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
        stringFunctions::printThis($this->html);
    }

    public function get() {
        echo 'You are inside get method of parent class';
    }

    public function post() {
        echo 'You are inside post method of parent class';
    }
}

?>