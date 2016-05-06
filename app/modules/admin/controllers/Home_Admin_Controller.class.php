<?php

class Home_Admin_Controller extends Controller
{

    public function indexAction ()
    {
        echo 'opaweow<br>';
        echo MD5('admin') . '<br>';
        echo $this->instances->Security()->encrypt('admin') . '<br>';
        echo $this->instances->Security()->decrypt('YWRtaW4=');

    }

}