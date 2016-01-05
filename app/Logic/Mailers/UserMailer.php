<?php

namespace App\Logic\Mailers;

class UserMailer extends Mailer {

    public function passwordReset($email, $data)
    {
        $view       = 'emails.password-reset';
        $subject    = $data['subject'];
        $fromEmail  = 'tuts@codingo.me';

        $this->sendTo($email, $subject, $fromEmail, $view, $data);
    }

}