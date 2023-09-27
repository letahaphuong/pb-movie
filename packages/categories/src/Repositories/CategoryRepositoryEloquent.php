<?php

namespace Package\Category\Repositories;

use Package\Category\Models\Category;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saveCategory($attribute)
    {
        return Category::create($attribute);
    }

    public function getCategory($id)
    {
        return Category::find($id);
    }

    public function fetchCategory()
    {
        return Category::all();
    }

    public function editCategory($attribute)
    {
        return Category::where('id', '=', $attribute['id'])->update($attribute);
    }

    public function exitsById($id)
    {
        return Category::findOrFail($id);
    }

    public function deleteCategory($category)
    {
        $category->delete();
    }
}
