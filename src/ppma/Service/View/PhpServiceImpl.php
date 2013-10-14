<?php


namespace ppma\Service\View;


use ppma\Service\EmptyServiceImpl;
use ppma\Service\ViewService;

class PhpServiceImpl extends EmptyServiceImpl implements ViewService
{
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