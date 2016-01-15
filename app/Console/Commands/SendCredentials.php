<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Data\Repositories\Users\UserRepositoryInterface;
use App\Services\MailService\MailSenderInterface;

class SendCredentials extends Command
{	
    protected $signature = 'mail:sendCreds';
    
    protected $description = 'Send credentials to users';
    
    protected $user;
	protected $mail;

    public function __construct(UserRepositoryInterface $user, MailSenderInterface $mail)
    {
        parent::__construct();

        $this->user = $user;
		$this->mail = $mail;
    }
    
    public function handle()
    {
       $users = $this->user->getCredsForMailing();
		foreach ($users as $user){	
		   $email = $user['email'];
		   $data = ['name' => $user['name'], 'login' => $email, 'password' =>  $user['password']];
		   $attributes = ['destination' => $email, 'subject' => 'Credentials for data center'];
		   $this->mail->send('mails.sendCreds', $data, $attributes);
		}	  
    }
}
