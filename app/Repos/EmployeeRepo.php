<?php

namespace App\Repos;

use App\Interfaces\BaseAdminSavedDataInterface;
use Illuminate\Support\Facades\App;
use App\Models\Employee;
use Validator,Auth,Artisan,Hash,File,Crypt;

class EmployeeRepo implements BaseAdminSavedDataInterface {
    use \App\Traits\ApiResponseTrait;

    /***
     * @param $request
     * @return mixed
     */
    public function all($request)
    {
        $data=Employee::orderBy('id','desc');
        if($request->search_text) {
            $data = $data->where(function ($q)use($request){
                $q->where('phone','LIKE','%'.$request->search_text.'%')
                    ->orWhere('email','LIKE','%'.$request->search_text.'%');
            });
        }
        if($request->department_id)
            $data=$data->where('department_id',$request->department_id);
        $data=$data->paginate(paginateNum());
        return $data;
    }

    /***
     * @param $request
     * @return mixed
     */
    public function single( $request)
    {
        $Employee=Employee::where('id',$request->employee_id);
        $Employee=$Employee->firstOrFail();
        return $Employee;
    }

    /***
     * @param $data
     * @param $request
     * @return mixed
     */
    public function saveData($data,$request)
    {
        $data->first_name=$request->first_name;
        $data->last_name=$request->last_name;
        $data->manger_name=$request->manger_name;
        $data->type=$request->type;
        $data->salary=$request->salary;
        $data->department_id=$request->department_id;
        $data->email=$request->email;
        $data->phone=$request->phone;
        if($request->password)
            $data->password=Hash::make($request->password);
        if($request->image){
            deleteFile('Employee',$data->image);
            $data->image=saveImage('Employee',$request->image);
        }
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

    /**
     * @param $data
     * @param $request
     * @return mixed|void
     */
    public function changeStatus($data,$request)
    {

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
        $validationMessages = [
            'name_ar.required' => __('responseValidation.name_ar') ,
        ];

        $validator = Validator::make($input, [
            'email' =>$data_id ? 'required|unique:employees,email,'.$data_id :  'required|unique:employees',
            'phone' =>$data_id ? 'required|unique:employees,phone,'.$data_id :  'required|unique:employees',
            'department_id'=>'required|exists:departments,id',
            'type'=>$data_id ? '' : 'in:1,2',
            'first_name'=>$data_id ? '' : 'required',
            'last_name'=>$data_id ? '' : 'required',
            'manger_name'=>$data_id ? '' : 'required',
            'salary'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ], $validationMessages);

        if ($validator->fails()) {
            return $this->apiResponseMessage(0,$validator->messages()->first(), 200);
        }
    }
}
