<?php


namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repos\EmployeeRepo;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, File ,Hash,Str;


class EmployeeController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    public function __construct(EmployeeRepo $EmployeeRepo)
    {
        $this->EmployeeRepo = $EmployeeRepo;
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $countries=$this->EmployeeRepo->all($request);
        return $this->apiResponseData(new EmployeeCollection($countries));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        $Employee=$this->EmployeeRepo->single($request);
        return $this->apiResponseData(new EmployeeResource($Employee));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function create(Request $request)
    {
        $validateEmployee=$this->EmployeeRepo->validateData($request);
        if(isset($validateEmployee))
            return $validateEmployee;
        $request['password']=Str::random(40);
        $Employee=$this->EmployeeRepo->saveData(new Employee(),$request);
        return $this->apiResponseData(new EmployeeResource($Employee));
    }

    /***
     * @param $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function update(Request $request)
    {
        $Employee=$this->EmployeeRepo->single($request);
        $validateEmployee=$this->EmployeeRepo->validateData($request,$Employee->id);
        if(isset($validateEmployee))
            return $validateEmployee;
        $Employee=$this->EmployeeRepo->saveData($Employee,$request);
        return $this->apiResponseData(new EmployeeResource($Employee));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $Employee=$this->EmployeeRepo->single($request);
        $this->EmployeeRepo->delete($Employee);
        return $this->apiResponseMessage(1,'deleted successfully');
    }

}
