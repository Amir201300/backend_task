<?php

namespace App\Repos;

use App\Interfaces\BaseAdminSavedDataInterface;
use Illuminate\Support\Facades\App;
use App\Models\Department;
use Validator,Auth,Artisan,Hash,File,Crypt;

class DepartmentRepo implements BaseAdminSavedDataInterface {
    use \App\Traits\ApiResponseTrait;

    /***
     * @param $request
     * @return mixed
     */
    public function all($request)
    {
        $data=Department::orderBy('id','desc');
        if($request->search_text)
            $data=$data->where('name','LIKE','%'.$request->search_text.'%');
        $data=$data->paginate(paginateNum());
        return $data;
    }

    /***
     * @param $request
     * @return mixed
     */
    public function single( $request)
    {
        $Department=Department::where('id',$request->department_id);
        $Department=$Department->firstOrFail();
        return $Department;
    }

    /***
     * @param $data
     * @param $request
     * @return mixed
     */
    public function saveData($data,$request)
    {
        $data->name=$request->name;
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

        $validator = Validator::make($input, [
            'name' =>$data_id ? 'required|unique:departments,name,'.$data_id :  'required|unique:departments',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseMessage(0,$validator->messages()->first(), 200);
        }
    }
}
