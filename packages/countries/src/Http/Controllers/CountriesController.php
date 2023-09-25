<?php

namespace Package\Country\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Package\Country\Repositories\CountryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CountriesController extends Controller
{
    protected const MIN_LENGTH_STR_NAME = 50;
    protected CountryRepository $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function deleteCountry($id): void
    {
        if (!empty($id)) {
            $checkExits = $this->countryRepository->exitsById($id);
            if ($checkExits) {
                $country = $this->countryRepository->getCountry($id);
                $this->countryRepository->deleteCountry($country);
            } else {
                throw new NotFoundHttpException("Country not found");
            }
        } else {
            throw new \Exception("Link does not exist");
        }
    }

    public function updateCountry(Request $request): void
    {
        Log::info("Edit country");

        $this->validateBeforeSaveCountry($request);
        $attribute = $request->all();

        if (!empty($attribute)) {
            $checkExits = $this->countryRepository->exitsById($attribute['id']);
            if ($checkExits) {
                $this->countryRepository->editCountry($attribute);
            } else {
                throw new NotFoundHttpException("country not found");
            }
        } else {
            throw new NotFoundHttpException("Please enter your data");
        }
    }

    public function getCountry($id)
    {
        Log::info("Get country");

        if (empty($id)) {
            throw new NotFoundHttpException("Id is empty");
        }
        $countryIds = $this->fetchCountry()->pluck('id')->toArray();

        if (!in_array($id, $countryIds)) {
            throw new NotFoundHttpException("Id not found");
        }
        return $this->countryRepository->getCountry($id);
    }

    public function createCountry(Request $request)
    {
        Log::info("Create Country");
        $this->validateBeforeSaveCountry($request);
        $attribute = $request->all();
        return $this->saveCountry($attribute);
    }

    public function fetchCountry()
    {
        Log::info("Fetch country");
        return $this->countryRepository->fetchCountry();
    }

    private function saveCountry($attribute)
    {
        $country = $this->countryRepository->saveCountry($attribute);
        return $country->id;
    }

    private function validateBeforeSaveCountry(Request $request)
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
