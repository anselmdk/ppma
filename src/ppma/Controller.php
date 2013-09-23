<?php


namespace ppma;


class Controller
{

    /**
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function json($data = array(), $status = 200, $headers = array())
    {
        return \ppma::app()->json($data, $status, $headers);
    }


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