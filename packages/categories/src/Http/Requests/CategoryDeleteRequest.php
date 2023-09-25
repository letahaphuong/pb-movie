<?php

namespace Package\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Package\Category\Models\Category;

class CategoryDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $accessUpdate = $this->checkCategoryDelete($value);
                    if ($accessUpdate) {
                        return true;
                    }

                    return $fail('Data is being used');
                }
            ],
            'name' => 'required'
        ];
    }

    private function checkCategoryDelete($id): bool
    {
        $category = Category::where('id', $id)->first();

        if (is_null($category)) {
            return true;
        }

        return false;
    }
}
