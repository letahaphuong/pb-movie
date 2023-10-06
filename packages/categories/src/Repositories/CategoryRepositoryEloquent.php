<?php

namespace Package\Category\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
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

    public function fetchMoviesBycategory($categoryName, array $columns, mixed $limit, float|int $offset)
    {
        return Category::select(array_merge($columns,['categories.id']))
        ->where(function (Builder $query) use ($columns, $categoryName, $limit, $offset) {
            scopeOrWhereLike($query, $columns, $categoryName);
        })
            ->with(['movies' => function (Builder $query) use ($limit, $offset) {
                $query->select('movies.id', 'movies.name', 'movies.name_english',
                    'movies.category_id', 'movies.created_at')
                    ->orderBy(CREATED_AT, DESC)
                    ->limit($limit)
                    ->offset($offset)
                    ->with(['medias' => function (Builder $query) {
                        $query->select('medias.id', 'medias.movie_id', 'medias.stored_key', 'medias.source_type');
                    }]);
            }])
            ->get();
    }
}
