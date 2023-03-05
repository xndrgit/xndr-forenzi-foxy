<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Personalize;
use App\Repositories\PersonalizeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonalizeController extends Controller
{
    protected $repository;

    public function __construct(PersonalizeRepository $personalizeRepository)
    {
        $this->repository = $personalizeRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'sender_email' => 'required|email',
            'first_name'   => 'required',
            'address'      => 'required',
            'length'       => 'required',
            'width'        => 'required',
            'height'       => 'required',
            'quantity'     => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 422);
        }

        $this->repository->requestCustomBox($request);

        return response()
            ->json([
                'success' => true
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Personalize $personalize
     *
     * @return void
     */
    public function destroy(Personalize $personalize)
    {
        //
    }
}
