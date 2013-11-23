<?php


namespace ppma\Service;


use ppma\Service;

interface SmtpService extends Service
{

    /**
     * @param array $to ['jane@doe.com' => 'Jane Doe']
     * @param string $subject
     * @param string $message
     * @return mixed
     */
    public function sendMessage($to, $subject, $message);

} 