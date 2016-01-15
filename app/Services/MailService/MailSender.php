<?php


namespace App\Services\MailService;

use Illuminate\Mail\Mailer;

class MailSender implements MailSenderInterface
{
	private $mail;	
	
	public function __construct(Mailer $mail)
	{
		$this->mail = $mail;	
	}
	
	public function send($view, $data, $attributes)
	{
		$this->mail->send($view, $data, function($msg) use ($attributes){
			$msg->from('inbox@mail.data-center.in.ua', 'Data Center');
            $msg->to($attributes['destination'])->subject($attributes['subject']);
		});
	}
	
	
}
