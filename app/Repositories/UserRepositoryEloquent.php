<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\User;

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

    public function fetchUsers()
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
}
