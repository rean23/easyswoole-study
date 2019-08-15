<?php


namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\EasySwoole\Config;

class Base extends Controller
{
    protected $config;

    public function index() {
        $this->actionNotFound();
    }
}