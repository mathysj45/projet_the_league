<?php
    class Router
    {
        public function handleRequest(array $get) : void
        {
            if(isset($_GET["route"]))
            {
                if($_GET["route"] === "team")
                {
                    $ctrl = new PageController();
                    $ctrl->team();
                }

                else if ($_GET["route"] === "player")
                {
                    $ctrl = new PageController();
                    $ctrl->player();
                }

                else if ($_GET["route"] === "match")
                {
                    $ctrl = new PageController();
                    $ctrl->match();
                }

                else
                {
                    $ctrl = new PageController();
                    $ctrl->notFound();
                }
            }

            else
            {
                $ctrl = new PageController();
                $ctrl->home();
            }
        }
    }
?>