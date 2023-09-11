<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRoleRepository;
use App\Entities\UserRole;
use App\Validators\UserRoleValidator;

/**
 * Class UserRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRoleRepositoryEloquent extends BaseRepository implements UserRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserRole::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saveUserRole($userId, $roleId)
    {
        return UserRole::create([
            'user_id' => $userId,
            'role_id' => $roleId]);
    }
}
