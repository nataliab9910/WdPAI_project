<?php


class Route {
    private string $url;
    private string $view;
    private int $role;

    public function __construct(string $url, string $view, int $role) {
        $this->url = $url;
        $this->view = $view;
        $this->role = $role;
    }

    public function getUrl():string {
        return $this->url;
    }

    public function getView():string {
        return $this->view;
    }

    public function getRole(): int {
        return $this->role;
    }

}