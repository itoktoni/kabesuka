<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class CreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {

            $insert = $data->all();
            $insert['email_verified_at'] == date('Y-m-d H:i:s');

            $check = $repository->saveRepository($insert);
            if(isset($check['status']) && $check['status']){
                $data['email_verified_at'] == date('Y-m-d H:i:s');
                Alert::create();
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}
