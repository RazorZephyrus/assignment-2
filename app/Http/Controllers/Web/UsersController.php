<?php

namespace App\Http\Controllers\Web;

use App\Exports\UsersExport;
use App\Http\Modules\BaseWebCrud;
use App\Models\User;
use App\Http\Requests\Web\RewardType\RewardTypeRequest;
use App\Http\Requests\Web\User\UserNewRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Web\User\UserEditRequest;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends BaseWebCrud
{
    public $model = User::class;
    public $viewPath = 'pages.users';

    public $storeValidator = UserNewRequest::class;
    public $updateValidator = UserEditRequest::class;

    public function __prepareDataStore($data) 
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.users.index'));
    }

    public function __afterStore()
    {
        $this->row->assignRole($this->requestData->input('role'));
    }

    public function __prepareDataUpdate($data)
    {
        if($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $data;
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function __afterUpdate()
    {
        $this->__afterStore();
    }

    public function export() {
        return Excel::download(new UsersExport, 'Users-'.date('YmdHis').'.xlsx');
    }
}