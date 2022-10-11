<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $update = $data->all();
        $update['email_verified_at'] = date('Y-m-d H:i:s');

        if(empty($update['password'])){
            unset($update['password']);
        }
        $check = $repository->updateRepository($update, $code);
        if ($check['status']) {
            if(request()->wantsJson()){
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
