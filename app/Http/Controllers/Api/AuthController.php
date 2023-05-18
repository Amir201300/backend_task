<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\EmployeeResource;

class AuthController extends Controller
{
    use \App\Traits\ApiResponseTrait;


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt($this->credentials($request))) {
            $employee = Auth::user();
            $token = $employee->createToken('Manger')->accessToken;
            $employee['my_token'] = $token;
            return $this->apiResponseData(new EmployeeResource($employee), 'login success', 200);
        }
        return $this->apiResponseMessage(0, 'invalid username or password', 200);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function credentials($request)
    {
        if(is_numeric($request->get('login_key'))){
            return ['phone'=>$request->login_key,'password'=>$request->password];
        }
        return ['email' => $request->login_key, 'password'=>$request->password];
    }

}
