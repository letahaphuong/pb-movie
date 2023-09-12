<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function fetchUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all(array('full_name', 'email', 'created_at'));
    }

    public function getUserById($id)
    {
        // TODO: Implement getUserById() method.
    }

    public function saveUser($user)
    {
        // TODO: Implement saveUser() method.
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    public function getBasicInfoById($id)
    {
        return User::select('email', 'full_name', 'created_at')
            ->where('id', $id)
            ->first();
    }
}
