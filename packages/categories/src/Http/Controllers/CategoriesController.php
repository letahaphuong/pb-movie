<?php

namespace Package\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Package\Category\Repositories\CategoryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends Controller
{
    protected const MIN_LENGTH_STR_NAME = 50;
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function deleteCategory($id): void
    {
        if (!empty($id)) {
            $checkExits = $this->categoryRepository->exitsById($id);
            if ($checkExits) {
                $category = $this->categoryRepository->getCategory($id);
                $this->categoryRepository->deleteCategory($category);
            } else {
                throw new NotFoundHttpException("Category not found");
            }
        } else {
            throw new \Exception("Link does not exist");
        }
    }

    public function updateCategory(Request $request): void
    {
        Log::info("Edit category");
        $this->validateBeforeSaveCategory($request);
        $attribute = $request->all();
        if (!empty($attribute)) {
            $checkExits = $this->categoryRepository->exitsById($attribute['id']);
            if ($checkExits) {
                $this->categoryRepository->editCategory($attribute);
            } else {
                throw new NotFoundHttpException("Category not found");
            }
        } else {
            throw new NotFoundHttpException("Please enter your data");
        }
    }

    public function getCategory($id)
    {
        Log::info("Get category");

        if (empty($id)) {
            throw new NotFoundHttpException("Id is empty");
        }
        $categoryIds = $this->fetchCategory()->pluck('id')->toArray();

        if (!in_array($id, $categoryIds)) {
            throw new NotFoundHttpException("Id not found");
        }
        return $this->categoryRepository->getCategory($id);
    }

    public function fetchCategory()
    {
        Log::info("Fetch category");
        return $this->categoryRepository->fetchCategory();
    }

    public function createCategory(Request $request)
    {
        Log::info("Create category");
        $this->validateBeforeSaveCategory($request);

        $attribute = $request->all();
        $category = $this->categoryRepository->create($attribute);

        return response()->json([
            'category_id' => $category->id
        ]);
    }

    private function validateBeforeSaveCategory(Request $request)
    {

        $name = $request->name;
        $message = null;
        $error_code = null;
        $field = null;

        if (!preg_match(USER_NAME, $name)) {
            $error_code = BAD_REQUEST;
            $message = 'Invalid name pattern';
            $field = 'name';
        }

        if (strlen($name) < self::MIN_LENGTH_STR_NAME) {
            $error_code = BAD_REQUEST;
            $message = 'Name must not be less than ' . self::MIN_LENGTH_STR_NAME . ' characters';
            $field = 'name';
        }

        return response()->json([
            'field' => $field,
            'message' => $message,
            'error_code' => $error_code
        ], STATUS_BAD_REQUEST);
    }
}
