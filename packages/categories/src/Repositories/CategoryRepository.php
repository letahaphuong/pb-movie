<?php

namespace Package\Category\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository.
 *
 * @package namespace App\Repositories;
 */
interface CategoryRepository extends RepositoryInterface
{
    public function saveCategory($attribute);

    public function getCategory($id);

    public function fetchCategory();

    public function editCategory($attribute);

    public function exitsById($id);

    public function deleteCategory($category);
}
