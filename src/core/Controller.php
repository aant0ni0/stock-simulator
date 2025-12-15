<?php

declare(strict_types=1);

class Controller{
    protected function render(string $view)
    {
        $content = __DIR__ . '/../../public/views/' . $view . '.php';
        $layout = __DIR__ . '/../../public/views/layout/main.php';

        if (!file_exists($content)) {
            http_response_code(500);
            echo "View not found";
            return;
        }

        require $layout;
    }
}