<?php

namespace mvc;

class Controller
{
    public $title = '';

    /**
     * @param string $viewName
     * @param array $params
     * @return string
     */
    public function getViewWithLayout($viewName, array $params = []): string
    {
        $content = $this->getView($viewName, $params);
        return $this->getView('layout', [
            'content' => $content,
            'title' => $this->title,
        ]);
    }

    /**
     * @param string $viewName
     * @param array $params
     * @return string
     */
    public function getView($viewName, array $params = []): string
    {
        $filePath = sprintf('%s/../%s/view/%s.php', __DIR__, Config::$config['sitePath'], $viewName);
        extract($params, EXTR_SKIP);

        ob_start();
        include $filePath;
        return ob_get_clean();
    }

    /**
     * @param string $string
     * @return string
     */
    public function encode($string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE);
    }
}