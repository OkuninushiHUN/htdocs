<?php
declare(strict_types=1); //szigorú típuskezelést követeli meg

namespace App;

use App\Exception\ViewNotFoundException;

class View
{
    private string $view; //nézet file helye, neve
    private array $params; //a nézeten megjelenő dinamikus elemek, értékek
    public function __construct(string $view, array $params)
    {
        $this->view = $view;
        $this->params = $params;

    }

    //view file helye, neve ->> view file elérési útját adja meg
    public function getViewFile() :string{

        $path = VIEW_PATH . $this->view . '.view.php';
        if (!file_exists($path))
        {
            throw new ViewNotFoundException();
        }
        return $path;
    }
    public function render() :string{
        $viewPath = $this->getViewFile();

        foreach ($this->params as $key => $value){
            $$key = $value; // double dollar variable...

        }

        ob_start();  //output buffer bekapcsolása
        include $viewPath;
        return (string) ob_get_clean(); //kikéri az OB tartalmát a változóba és utána törli a tartalmát
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public static  function make(string $view, array $params = []){
        return new static ($view, $params);
    }
}