<?php
    class PageController
    {
        public function home() : void
        {
            $route = "home";
            require "templates/layout.phtml";
        }

        public function team() : void
        {
            $route = "team";
            require "templates/layout.phtml";
        }

        public function player() : void
        {
            $route = "player";
            require "templates/layout.phtml";
        }

        public function match() : void
        {
            $route = "match";
            require "templates/layout.phtml";
        }

        public function notFound() : void
        {
            $route = "notFound";
            require "templates/layout.phtml";
        }
    }
?>