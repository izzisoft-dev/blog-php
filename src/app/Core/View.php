<?php

namespace App\Core;

use Smarty\Smarty;

class View {

    private Smarty $smarty;

    public function __construct(){
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../../resources/views/');                                                    
        $this->smarty->setCompileDir(__DIR__ . '/../../resources/compiled/');                                                  
        $this->smarty->setCacheDir(__DIR__ . '/../../resources/cache/'); 
    }

    public function render(string $template, array $data = []): void{
        foreach ($data as $key => $value){
            $this->smarty->assign($key, $value);
        }
        $this->smarty->display($template . '.tpl');
    }
}