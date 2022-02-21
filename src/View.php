<?php

declare(strict_types=1);

namespace Task;

class View
{
    public function render(string $page,string $site,array $dataParams=[]):void
    {
        $dataParams = $this->escape($dataParams);
        require_once("templates/layout.php");
    }

    private function escape(array $params) :array
    {
        $cleardata = [];

        foreach($params as $key => $param)
        {
            if(is_array($param))
            {
                $cleardata[$key] = $this->escape($param);
            }else if ($param)
            {
                $cleardata[$key] = htmlentities($param);
            } else {
                $cleardata[$key] = $param;
            }
        }
        return $cleardata;
    }
}
