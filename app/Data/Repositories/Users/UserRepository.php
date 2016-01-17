<?php

namespace App\Data\Repositories\Users;

use App\Data\Repositories\AbstractRepository;
use App\Data\Models\User;
use Illuminate\Encryption\Encrypter;
use Illuminate\Contracts\Hashing\Hasher;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $encrypter;

    public function __construct(User $user, Hasher $encrypter)
    {
        $this->model = $user;
        $this->encrypter = $encrypter;
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

    public function getCredsForMailing()
    {
        return $users = $this->model->get(['name', 'email', 'password']);
        //return $this->decryptPasses($users);
    }

    public function encryptPasses()
    {
        $users = User::all();
        foreach ($users as $user){
            $user->password = $this->encrypter->make($user->password);
            $user->save();
        }
    }

    public function update($name, $requestArray)
    {

    }

    private function decryptPasses($users)
    {
        return $users->map(function ($user) {
            $user->password = $this->encrypter->decrypt($user->password);
            return $user;
        });
    }

}
