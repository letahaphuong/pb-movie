<?php

namespace Package\Comment\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Package\Movie\Models\MovieEpisode;

class CommentFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "content" => [
                'required', 'max:3000'
            ],
            "movie_episode_id" => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->checkAccessAddComment($value) ? true : $fail("Movie episode id is not found");
                }
            ],
            "user_id" => [
                'required',
                function ($attribute, $value, $fail) {
                    return $this->checkAccessAddComment($value) ? true : $fail("User id is not found");
                }
            ]
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

    private function checkAccessAddComment($id)
    {
        return User::where('id', $id)->exists() || MovieEpisode::where('id', $id)->exists();
    }
}
