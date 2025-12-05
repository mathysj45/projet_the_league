<?php

abstract class AbstractController
{
    protected function render(string $template, array $data) : void
    {
        var_dump($data);
        die;
        require "templates/layout.phtml";
    }

    protected function redirect(string $route) : void
    {
        header("Location: $route");
    }
}