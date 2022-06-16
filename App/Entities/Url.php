<?php

namespace App\Entities;

class Url
{
    public static $url;
    private string $action;
    private int $id;
    private array $info;
    private string $controller;

    private function __construct()
    {
    }

    public static function make(): Url
    {
        if (Url::$url != null) {
            return Url::$url;
        }

        Url::$url = new Url;
        Url::$url->info = explode('/', $_SERVER['REQUEST_URI']);
        Url::$url->controller = Url::$url->info[1];

        if (Url::$url->controller == 'books') {

            if (empty(Url::$url->info[2])) {
                Url::$url->action = 'Index';
                Url::$url->id = 0;
            } elseif ((int)Url::$url->info[2] * 2 != 0 && empty(Url::$url->info[3])) {
                Url::$url->action = 'Show';
                Url::$url->id = (int)Url::$url->info[2];
            } elseif (Url::$url->info[2] == 'deletecomment') {
                Url::$url->action = 'DeleteComment';
                Url::$url->id = 0;
            } elseif ((int)Url::$url->info[2] * 2 != 0 && Url::$url->info[3] == 'createcomment') {
                Url::$url->action = 'CreateComment';
                Url::$url->id = (int)Url::$url->info[2];
            }
        }
        return Url::$url;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}
