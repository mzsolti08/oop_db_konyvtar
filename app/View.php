<?php

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    private string $view;
    private array $params = [];

    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    public function render() : string {
        $viewPath = VIEW_PATH.$this->view.'.v.php'; // /resources/view/<view>.v.php

        if (!file_exists($viewPath)){
            throw new ViewNotFoundException();
        }
        /*
         [
            'user_name' => 'pista'          $user_name = 'pista';
            'filmek' => [......]            $filmek = [....];
            ]
         * */
        foreach ($this->params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include $viewPath;
        return (string) ob_get_clean();
    }

    public function __toString(): string {
        return $this->render();
    }

    public function __get(string $name){
        return $this->params[$name] ?? null;
    }

    public static function make(string $view, array $params = []){
        return new static ($view, $params);
    }
}