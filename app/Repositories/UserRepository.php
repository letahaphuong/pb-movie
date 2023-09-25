<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function fetchUsers();
    public function getUserById($id);
    public function saveUser($user);
    public function deleteById($id);
    public function getBasicInfoById($id);
}
