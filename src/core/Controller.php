<?php

declare(strict_types=1);

class Controller{
    protected function render(string $view, array $data = [], string $layout = 'main'): void
    {
        extract($data);

        $content = __DIR__ . '/../../public/views/' . $view . '.php';
       $layoutFile = __DIR__ . '/../../public/views/layout/' . $layout . '.php';

        if (!file_exists($content) || !file_exists($layoutFile)) {
            http_response_code(500);
            echo 'View or layout not found';
            return;
        }

        require $layoutFile;
    }
}