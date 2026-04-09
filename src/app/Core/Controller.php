<?php

namespace App\Core;

use App\Core\View;

class Controller {

    protected View $view;

    public function __construct(){
        $this->view = new View;
    }

    protected function view(string $template, array $data = []): void{
        $this->view->render($template, $data);
    }

}