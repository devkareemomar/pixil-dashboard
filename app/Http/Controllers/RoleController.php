<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\RoleRequest;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct(
        protected RoleRepository       $roleRepository,
        protected PermissionRepository $permissionRepository
    )
    {
//        $this->middleware('permission:role-read|role-create|role-update|role-delete', ['only' => ['index']]);
//        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:role-update', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = $this->roleRepository->all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::pluck('name', 'id')->toArray();
        $permissionColumns = $this->getPermissionColumns($permissions);
        return view('roles.create', compact('permissions' , 'permissionColumns'));
    }

    public function store(RoleRequest $request)
    {
        $this->roleRepository->create($request->validated());
        return redirect()->route('roles.index')->with('success',  __('Role created successfully.'));
    }

    public function edit($id)
    {
        $role = $this->roleRepository->find($id);
        $permissions = Permission::pluck('name', 'id')->toArray();
        $permissionColumns = $this->getPermissionColumns($permissions);
        return view('roles.edit', compact('role', 'permissionColumns', 'permissions'));
    }

    public function update(RoleRequest $request, $id)
    {
        $this->roleRepository->update($id, $request->validated());
        return redirect()->route('roles.index')->with('success',  __('Role updated successfully.'));
    }

    public function destroy($id)
    {
        $this->roleRepository->delete($id);
        return redirect()->route('roles.index')->with('success',  __('Role deleted successfully.'));
    }

    public function getPermissionColumns($permissions)
    {
        $permissionColumns = [];
        $currentCategory = null;

        foreach ($permissions as $permissionId => $permissionName) {
            // project-status-create => project-status
            $category = explode('-', $permissionName);
            unset($category[count($category) - 1]); // remove last element
            $category = implode('-', $category);

            if ($currentCategory !== $category) {
                $currentCategory = $category;
                $permissionColumns[$currentCategory] = [];
            }

            $permissionColumns[$currentCategory][] = $permissionId;
        }
        return $permissionColumns;

    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Role::class,$selectedRows);
        return back()->with('success',  __('Role deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),__('Name')
        ];
        $data = Role::select('id','name')->get();
        return Excel::download(new exportToExcel($data, $array), 'Roles.csv');
    }
}
