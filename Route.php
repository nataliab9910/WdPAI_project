<?php


class Route
{
    private $url;
    private $view;
    private $role;

    public function __construct($url, $view, $role)
    {
        $this->url = $url;
        $this->view = $view;
        $this->role = $role;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getView()
    {
        return $this->view;
    }

    public function getRole()
    {
        return $this->role;
    }


}