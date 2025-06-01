<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        return view('users.show_users', compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.Add_user', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required',
            'status' => 'required|in:0,1' // Ensure status is either '0' or '1'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Ensure user status is set correctly (0 = Inactive, 1 = Active)
        if (!in_array($input['status'], [0, 1])) {
            return back()->with('error', 'الحالة غير صالحة');
        }

        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));

        session()->flash('add_user', 'تم اضافة المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|same:confirm-password',
            'roles' => 'required',
            'status' => 'required|in:0,1' // Ensure status is either '0' or '1'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);

        // If status is changed to '0' (inactive), ensure other business rules are checked here
        if ($input['status'] === 0 && $user->status !== 0) {
            // Implement any additional checks before changing the status to inactive
        }

        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        session()->flash('update_user', 'تم تحديث معلومات المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();
        session()->flash('delete_user', 'تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }
}
 