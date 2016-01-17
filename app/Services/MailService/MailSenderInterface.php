<?php

namespace App\Services\MailService;

interface MailSenderInterface
{
	public function send($view, $data, $attributes);
}
