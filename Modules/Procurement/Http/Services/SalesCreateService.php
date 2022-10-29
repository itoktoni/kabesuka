<?php

namespace Modules\Procurement\Http\Services;

use Modules\Procurement\Dao\Facades\SoDetailFacades;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class SalesCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        // try {
            $check = $repository->saveRepository($data->all());
            SoDetailFacades::insert($data['detail']);
            if(isset($check['status']) && $check['status']){

                Alert::create();
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        // } catch (\Throwable $th) {
            // Alert::error($th->getMessage());
            // return $th->getMessage();
        // }

        return $check;
    }
}
