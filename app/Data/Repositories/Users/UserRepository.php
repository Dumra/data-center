<?php

namespace App\Data\Repositories\Users;

use App\Data\Repositories\AbstractRepository;
use App\Data\Models\User;
use Illuminate\Encryption\Encrypter;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
	public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function create($array)
	{
		
	}

	public function delete($name)
	{
		
	}

	public function get($name)
	{
		
	}

	public function getCredsForMailing(Encrypter $encrypter)
	{
		$users = $this->model->get(['name', 'email', 'password']);
		return $this->decryptPasses($users, $encrypter)->toArray();
	}

	public function update($name, $requestArray)
	{
		
	}
	
	private function decryptPasses($users, $encrypter)
	{
		return $users->map(function ($user){
			$user->password = $encrypter->decrypt($user->password);
			return $user;
		});
	}

}
