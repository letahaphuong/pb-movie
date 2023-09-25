<?php

namespace Package\Movie\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Package\Category\Models\Category;
use Package\Country\Models\Country;
use Package\MovieType\Models\MovieType;

class MovieFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => [
                'required',
                'max:200',
                'regex:/^[a-zA-Z\sàáảãạăắằẳẵặâấầẩẫậèéẻẽẹêếềểễệđìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ]+$/',
                'min:6'
            ],
            "name_english" => ['required', 'max:200', "regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", 'min:6'],
            "key_word" => ['required', 'max:100'],
            "actor_name" => ['required', 'max:255', 'min:6'],
            "director" => ['required', 'max:100', 'min:6'],
            "release_year" => ['required', 'regex:/^[1-9][0-9]{3}$/'],
            "time" => ['required'],
            "description" => ['required', 'max:3000'],
            "view" => [],
            "category_id" => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->checkAccessAddMovie($value) ? true : $fail("Category id is not found");
                }
            ],
            "movie_type_id" => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->checkAccessAddMovie($value) ? true : $fail("Movie type id is not found");
                }
            ],
            "country_id" => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->checkAccessAddMovie($value) ? true : $fail("Country id is not found");
                }
            ],
            "name_episode" => ['required', 'max:4'],
            "image_film" => ['required'],
            "poster_film" => ['required'],
            "normal_quality_film" => ['required'],
            "high_quality_film" => [],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    private function checkAccessAddMovie($id)
    {
        return Country::find($id) || Category::find($id) || MovieType::find($id);
    }

}
