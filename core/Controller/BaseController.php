<?php namespace Core\Controller;

abstract class BaseController{
    protected function renderView(string $view, array $data = [])
    {
        extract($data);

        ob_start();
        require __DIR__ . "/../../app/Views/{$view}.php";
        $content = ob_get_clean();

        // Если title не установлен, зададим значение по умолчанию
        $title = $title ?? 'Default Title';
        // Если layout не установлен, зададим значение по умолчанию
        $layout = $layout ?? 'Layouts/Main';

        require __DIR__ . "/../../app/Views/{$layout}.php";
    }

    protected function renderJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}