<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct(
        protected UserRepository $userRepository,
        protected RoleRepository $roleRepository
    )
    {
        $this->middleware('permission:user-read|user-create|user-update|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::filter()->paginate();
        $roles = Role::all();
        return view('users.index', compact('users','roles'));
    }

    public function create()
    {
        $roles = $this->roleRepository->all();
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->userRepository->create($request->validated());

        return redirect()->route('users.index')->with('success',  __('User created successfully.'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $roles = $this->roleRepository->all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update($id, $request->validated());
        return redirect()->route('users.index')->with('success',  __('User updated successfully.'));
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('users.index')->with('success',  __('User deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(User::class,$selectedRows);
        return back()->with('success',  __('User deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),
            __('Name'),
            __('Email'),
            __('Username'),
            __('Phone'),
            __('Status'),
        ];
        $data = User::select('id','name','email','username','phone','status')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Users.csv');
    }
}
