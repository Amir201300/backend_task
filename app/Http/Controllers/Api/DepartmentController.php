<?php


namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\DepartmentCollection;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Repos\DepartmentRepo;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, File ,Hash;


class DepartmentController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    public function __construct(DepartmentRepo $DepartmentRepo)
    {
        $this->DepartmentRepo = $DepartmentRepo;
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $countries=$this->DepartmentRepo->all($request);
        return $this->apiResponseData(new DepartmentCollection($countries));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        $Department=$this->DepartmentRepo->single($request);
        return $this->apiResponseData(new DepartmentResource($Department));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function create(Request $request)
    {
        $validateDepartment=$this->DepartmentRepo->validateData($request);
        if(isset($validateDepartment))
            return $validateDepartment;
        $Department=$this->DepartmentRepo->saveData(new Department(),$request);
        return $this->apiResponseData(new DepartmentResource($Department));
    }

    /***
     * @param $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function update(Request $request)
    {
        $Department=$this->DepartmentRepo->single($request);
        $validateDepartment=$this->DepartmentRepo->validateData($request,$Department->id);
        if(isset($validateDepartment))
            return $validateDepartment;
        $Department=$this->DepartmentRepo->saveData($Department,$request);
        return $this->apiResponseData(new DepartmentResource($Department));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $Department=$this->DepartmentRepo->single($request);
        if($Department->employees->count() > 0)
            return $this->apiResponseMessage(1,'The department cannot be deleted because it contains employees');
        $this->DepartmentRepo->delete($Department);
        return $this->apiResponseMessage(1,'deleted successfully');
    }

}
