<?php

namespace Package\Movie\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Package\Movie\Models\Movie;

class MovieEpisodeFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "movie_id" => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->checkAccessAddMovie($value) ? true : $fail("Movie id is not found");
                }
            ],
            "name_episode" => ['required', 'max:4'],
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
        return Movie::find($id);
    }
}
