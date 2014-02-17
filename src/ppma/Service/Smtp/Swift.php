<?php


namespace ppma\Service\Smtp;


use ppma\Logger;
use ppma\Service\ServiceImpl;
use ppma\Service\SmtpService;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Swift extends ServiceImpl implements SmtpService
{

    /**
     * @var Swift_Mailer;
     */
    protected $mailer;

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $host     = $this->app->config('mail.smtp.host');
        $port     = $this->app->config('mail.smtp.port');
        $username = $this->app->config('mail.smtp.username');
        $password = $this->app->config('mail.smtp.password');
        $security = ($this->app->config('mail.smtp.tls') ? 'tls' : null);

        $transport = Swift_SmtpTransport::newInstance($host, $port, $security)
            ->setUsername($username)
            ->setPassword($password)
        ;

        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    /**
     * @param array $to ['jane@doe.com' => 'Jane Doe']
     * @param string $subject
     * @param string $message
     * @return mixed
     */
    public function sendMessage($to, $subject, $message)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        /* @var \Swift_Mime_Message $message */
        $message = Swift_Message::newInstance($subject)
            ->setFrom(array($this->app->config('mail.from')))
            ->setTo($to)
            ->setBody($message)
        ;

        // Send the message
        if (!is_null($this->app->config('mail.dryrun'))) {
            $this->mailer->send($message);
        }
    }
}
