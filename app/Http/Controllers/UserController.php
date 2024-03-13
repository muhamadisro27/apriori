<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Service\CommandSQL;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Trim;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(protected CommandSQL $command_sql)
    {
        $this->command_sql = $command_sql;
    }

    public function index(): View
    {
        return view('admin.user.table');
    }

    public function get_data(): JsonResponse
    {
        if (request()->ajax()) {
            $model = User::filter();

            $datatable =  DataTables::eloquent($model);

            $no = 1;
            $datatable->addColumn('No', function ($dataset) use ($no) {
                $no++;
                return $no;
            })
                ->addColumn('Action', 'admin.user.action')
                ->addColumn('Name', function ($model) {
                    return $model->name;
                })
                ->addColumn('Phone Number', function ($model) {
                    return $model->phone_number;
                })
                ->addColumn('Email', function ($model) {
                    return $model->email;
                });

            return $datatable->rawColumns(['Action'])->make(true);
        }
    }

    public function form(User $user): View
    {
        return view('admin.user.form', compact('user'));
    }

    public function save(UserRequest $request, User $user): JsonResponse
    {
        $request_data = [
            'name' => trim($request->name),
            'email' => trim($request->email),
            'phone_number' => trim($request->phone_number)
        ];

        if (!isset($user->id)) {
            $request_data = array_merge($request_data, [
                'password' => Hash::make(trim($request->password)),
            ]);
        } else {
            $request_data = array_merge($request_data, [
                'password' => $user->password,
            ]);
        }

        $response = $this->command_sql->updateOrCreate($request_data, $user, 'User');

        return response()->json($response);
    }

    public function destroy(User $user): JsonResponse
    {
        $response = $this->command_sql->destroy('User', $user);

        return response()->json($response);
    }

    public function change_password_form(): View
    {
        $user = auth()->user();
        // $mode = $this->str->getMode($user);

        return view('pages.user-management.user.change-password', compact('user'));
    }

    public function change_password(ChangePasswordRequest $request, User $user)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => trans('auth.current_password'),
            ]);
        }

        if ($request->new_password != $request->confirm_password) {
            throw ValidationException::withMessages([
                'confirm_password' => trans('auth.confirm_password'),
            ]);
        }

        $data = [
            'password' => Hash::make($request->new_password)
        ];

        $response = $this->command_sql->updateOrCreate($data, $user, 'Change Password');

        User::withoutEvents(function () use ($request) {

            auth()->guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        });

        return response()->json($response);
    }
}
