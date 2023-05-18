<?php

namespace App\Repos;

use App\Interfaces\BaseAdminSavedDataInterface;
use Illuminate\Support\Facades\App;
use App\Models\Task;
use Validator,Auth,Artisan,Hash,File,Crypt;

class TaskRepo implements BaseAdminSavedDataInterface {
    use \App\Traits\ApiResponseTrait;

    /***
     * @param $request
     * @return mixed
     */
    public function all($request)
    {
        $data=Task::orderBy('id','desc');
        if($request->employee_id)
            $data=$data->where('employee_id',$request->employee_id);
        $data=$data->paginate(paginateNum());
        return $data;
    }

    /***
     * @param $request
     * @return mixed
     */
    public function single( $request)
    {
        $Task=Task::where('id',$request->task_id);
        $Task=$Task->firstOrFail();
        return $Task;
    }

    /***
     * @param $data
     * @param $request
     * @return mixed
     */
    public function saveData($data,$request)
    {
        $data->title=$request->title;
        $data->description=$request->description;
        $data->employee_id=$request->employee_id;
        $data->status=$request->status;
        $data->save();
        return $data;
    }

    /***
     * @param $data
     * @return mixed|void
     */
    public function delete($data)
    {
        $data->delete();
    }

    /***
     * @param $data
     * @return mixed
     */
    public function changeStatus($data,$request)
    {
        $data->status=$request->status;
        $data->save();
    }

    /***
     * @param $request
     * @param null $data_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function validateData($request, $data_id = null)
    {
        $lang = $request->header('lang') ;
        App::setLocale($lang);
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' =>'required',
            'description' =>'required',
            'employee_id' =>'required|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseMessage(0,$validator->messages()->first(), 200);
        }
    }
}
