<?php


namespace ppma;


class Controller {

    /**
     * @param string $template
     * @return string
     */
    protected function render($template)
    {
        ob_start();
        include sprintf('%s/%s.php', realpath(__DIR__ . '/../../views'), $template);
        return ob_get_clean();
    }

}