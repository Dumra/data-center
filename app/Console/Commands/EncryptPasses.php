<?php
/**
 * Created by PhpStorm.
 * User: dshul
 * Date: 1/17/2016
 * Time: 3:44 AM
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Data\Repositories\Users\UserRepositoryInterface;

class EncryptPasses extends Command
{
    protected $user;

    protected $signature = 'db:encryptPasses';

    protected $description = 'Encrypt users passes';

    public function __construct(UserRepositoryInterface $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    public function handle()
    {
        $this->user->encryptPasses();
    }


}