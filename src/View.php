<?php

declare(strict_types=1);

namespace Task;

class View
{
    public function render(string $page,string $site,array $dataParams)
    {
        require_once("templates/layout.php");
    }
}
