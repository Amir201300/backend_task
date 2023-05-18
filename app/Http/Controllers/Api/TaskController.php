<?php


namespace App\Http\Controllers\Api;

use App\Http\Resources\Collections\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repos\TaskRepo;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, File ,Hash;


class TaskController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    public function __construct(TaskRepo $TaskRepo)
    {
        $this->TaskRepo = $TaskRepo;
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $countries=$this->TaskRepo->all($request);
        return $this->apiResponseData(new TaskCollection($countries));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        $Task=$this->TaskRepo->single($request);
        return $this->apiResponseData(new TaskResource($Task));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function create(Request $request)
    {
        $validateTask=$this->TaskRepo->validateData($request);
        if(isset($validateTask))
            return $validateTask;
        $Task=$this->TaskRepo->saveData(new Task(),$request);
        return $this->apiResponseData(new TaskResource($Task));
    }

    /***
     * @param $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function update(Request $request)
    {
        $Task=$this->TaskRepo->single($request);
        $validateTask=$this->TaskRepo->validateData($request,$Task->id);
        if(isset($validateTask))
            return $validateTask;
        $Task=$this->TaskRepo->saveData($Task,$request);
        return $this->apiResponseData(new TaskResource($Task));
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $Task=$this->TaskRepo->single($request);
        $this->TaskRepo->delete($Task);
        return $this->apiResponseMessage(1,'deleted successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function change_status(Request $request){
        $Task=$this->TaskRepo->single($request);
        if($Task->employee_id != Auth::user()->id)
            return $this->apiResponseMessage(0,'you cant change status of this task');
        $this->TaskRepo->changeStatus($Task,$request);
        return $this->apiResponseData(new TaskResource($Task));

    }

}
