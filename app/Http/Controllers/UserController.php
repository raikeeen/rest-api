<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ResetStoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userService->getUsers();

        return response()->json(new UserCollection($users), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        $token = $user->createToken('AuthToken')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GetRequest $getRequest, User $user)
    {
        return response()->json(new UserResource($user), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $updateRequest, User $user)
    {
        $this->userService->updateUser($updateRequest->validated(), $user);

        return response()->json(['message' => 'User has been updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        if (auth()->attempt($loginRequest->validated())) {
            $token = auth()->user()->createToken('AuthToken')->accessToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorised'], 401);
    }

    /**
     * @param ResetRequest $resetRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordReset(ResetRequest $resetRequest)
    {
        $this->userService->sendResetToken($resetRequest->validated());

        return response()->json(['message' => 'Mail has been sent successfully'], 200);
    }

    /**
     * @param ResetStoreRequest $storeRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordUpdate(ResetStoreRequest $storeRequest)
    {
        $this->userService->updateUserPasswordAfterReset($storeRequest->validated());

        return response()->json(['message' => 'The password has been updated'], 200);
    }
}
