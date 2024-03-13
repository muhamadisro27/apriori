<?php

namespace App\Service;

use App\Helper\Str;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CommandSQL {
    public function __construct(protected Str $str)
    {
    }

    public function updateOrCreate($data, $model, $name)
    {
        try {
            DB::beginTransaction();

            switch ($name) {
                case 'Change Password':
                    User::withoutEvents(function () use ($model, $data) {
                        $model->updateOrCreate([
                            'uuid' => $model['uuid'] ?? Uuid::uuid1(),
                        ], $data);
                    });
                    break;
                case 'User':
                    User::withoutEvents(function () use ($model, $data) {
                        User::where('email', $data['email'])->withTrashed()->each(function ($u) {
                            $u->roles()->detach();
                            $u->forceDelete();
                        });
                    });

                    $model->updateOrCreate([
                        'uuid' => $model['uuid'] ?? Uuid::uuid1(),
                    ], $data);

                    break;

                default:
                    $model->updateOrCreate([
                        'uuid' => $model['uuid'] ?? Uuid::uuid1(),
                    ], $data);
                    break;
            }

            DB::commit();

            $response = $this->str->initial_response($name . ' has been successfully ' . (!isset($model->id) ? 'created' : 'updated'));
        } catch (\Throwable $th) {

            DB::rollBack();

            $response = $this->str->initial_response($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    public function destroy($name, $model)
    {
        try {
            DB::beginTransaction();

            $model->deleted_at = now();
            $model->save();

            DB::commit();

            $response = $this->str->initial_response($name . ' has been successfully deleted');
        } catch (\Throwable $th) {

            DB::rollBack();

            $response = $this->str->initial_response($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}


?>
