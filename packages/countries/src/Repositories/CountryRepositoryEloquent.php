<?php

namespace Package\Country\Repositories;

use Package\Country\Models\Country;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class CountryRepositoryEloquent extends BaseRepository implements CountryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Country::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saveCountry($attribute)
    {
        return Country::create($attribute);
    }

    public function getCountry($id)
    {
        return Country::findOrFail($id);
    }

    public function fetchCountry()
    {
        return Country::all();
    }

    public function editCountry($attribute)
    {
        return Country::where('id', '=', $attribute['id'])->update($attribute);

    }

    public function exitsById($id)
    {
        return Country::findOrFail($id);
    }

    public function deleteCountry($country)
    {
        $country->delete();
    }
}
