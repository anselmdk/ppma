<?php


namespace ppma\Service\Smtp;


use ppma\Config;
use ppma\Service\SmtpService;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SwiftServiceImpl implements SmtpService
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
        $host     = Config::get('mail.smtp.host');
        $port     = Config::get('mail.smtp.port');
        $username = Config::get('mail.smtp.username');
        $password = Config::get('mail.smtp.password');
        $security = (Config::get('mail.smtp.tls', false) ? 'tls' : null);

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
        /* @var \Swift_Mime_Message $message */
        $message = Swift_Message::newInstance($subject)
            ->setFrom(array(Config::get('mail.from', 'ppma@pklink.github.com')))
            ->setTo($to)
            ->setBody($message)
        ;

        // Send the message
        if (!Config::get('mail.dryrun', false))
        {
            $this->mailer->send($message);
        }
    }


} 