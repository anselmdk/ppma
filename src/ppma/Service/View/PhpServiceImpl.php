<?php


namespace ppma\Service\View;


use ppma\Service\ViewService;

class PhpServiceImpl implements ViewService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
    }

    /**
     * @param string $template
     * @return mixed
     */
    public function render($template)
    {
        ob_start();
        include sprintf('%s/%s.php', realpath(__DIR__ . '/../../../../views'), $template);
        return ob_get_clean();
    }

}