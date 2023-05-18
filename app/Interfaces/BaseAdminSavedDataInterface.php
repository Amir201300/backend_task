<?php

namespace App\Interfaces;

interface BaseAdminSavedDataInterface {
    /***
     * @param $request
     * @return mixed
     */
    public function all($request);

    /**
     * @param $request
     * @return mixed
     */
    public function single($request);


    /***
     * @param $data
     * @param $request
     * @return mixed
     */
    public function saveData($data,$request);

    /**
     * @param $data
     * @return mixed
     */
    public function delete($data);

    /**
     * @param $data
     * @param $request
     * @return mixed
     */
    public function changeStatus($data,$request);

    /***
     * @param $request
     * @param $data_id
     * @return mixed
     */
    public function validateData($request,$data_id=null);

}
