<?php

namespace Daoo\Aula03\view;

class View
{
    private $base_url;
    private $url;
    private $asset;
    private $template;

    public function __construct()
    {
        $this->url  = 'http://localhost:8080';
        $this->base_url = '/';
        $this->template = 'default';

        if (count($_ENV)) {
            $this->url  = $_ENV['APP_HOST'];
            $this->base_url = $_ENV['APP_BASE_URL'];
            if(isset($_ENV['APP_TEMPLATE']))
                 $this->template = $_ENV['APP_TEMPLATE'];
        }

        $this->asset = $this->url.$this->base_url;
        $this->asset .= "view/templates/".$this->template . "/assets/";
    }


    public function load($page, $data = null)
    {
        include_once __DIR__."/templates/" . $this->template . "/$page.php";
    }

    public function index()
    {
        $this->location($this->url);
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        $this->asset = $this->url.$this->base_url;
        $this->asset .= "view/templates/".$this->template . "/assets/";
    }

    public function location($url)
    {
        header("Location: $url");
    }

}
