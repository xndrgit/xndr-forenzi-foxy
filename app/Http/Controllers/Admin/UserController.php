<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\UserDetail;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        $users = $this->repository->getAllUsersWithDetail();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users.create', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    : RedirectResponse
    {

        $data = $request->all();

        // dd($data);
        $oldData = new User();
        $oldData->name = $data['name'];
        $oldData->email = $data['email'];
        $oldData->password = Hash::make($data['password']);
        $oldData->save();


        return redirect()
            ->route('admin.users.show', $oldData->id)
            // ->route('admin.products.index')
            ->with('created', $data['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if (!$user->user_detail) {
            $this->createUserDetail($user);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (!$user->user_detail) {
            $this->createUserDetail($user);
        }
        $levels = UserDetail::select('admin')->distinct()->get();
        return view('admin.users.edit', compact('user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $oldData = User::findOrFail($id);
        // dd($data);

        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,' . $oldData->id,
            'password'      => 'max:16',
            'surname'       => 'required|string|max:255',
            'business_name' => 'string|max:255',
            'address'       => 'required|string|max:255',
            'cap'           => 'required|string',
            'city'          => 'required|string|max:255',
            'province'      => 'required|string|max:255',
            'state'         => 'required|string|max:255',
            'phone'         => 'required|string|max:15',
            'pec'           => 'required|string|max:255',
            'code_sdi'      => 'required|integer',
            'notes'         => 'string|max:255',
            'admin'         => 'required'
        ]);

        // i already have a column admin for the user
        // foreach ($request->roles as $role) {

        //     $roleId = $role['role_id'];
        //     $thisRole = Role::findOrFail($roleId);

        //     $thisRole->name = $role['name'];
        //     switch ($role['name']) {
        //         case 'super admin':
        //             $thisRole->level = 0;
        //             break;
        //         case 'admin':
        //             $thisRole->level = 1;
        //             break;
        //         case 'moderator':
        //             $thisRole->level = 2;
        //             break;
        //         case 'editor':
        //             $thisRole->level = 3;
        //             break;
        //         case 'designer':
        //             $thisRole->level = 3;
        //             break;
        //         case 'vip-member':
        //             $thisRole->level = 4;
        //             break;
        //         case 'member':
        //             $thisRole->level = 5;
        //             break;
        //         case 'registered':
        //             $thisRole->level = 6;
        //             break;
        //     }
        //     $thisRole->save();
        // }

        $oldData->name = $data['name'];
        $oldData->email = $data['email'];
        $oldData->password = Hash::make($data['password']);
        $oldData->save();

        $oldData->user_detail->surname = $data['surname'];
        $oldData->user_detail->business_name = $data['business_name'];
        $oldData->user_detail->address = $data['address'];
        $oldData->user_detail->cap = $data['cap'];
        $oldData->user_detail->city = $data['city'];
        $oldData->user_detail->province = $data['province'];
        $oldData->user_detail->state = $data['state'];
        $oldData->user_detail->phone = $data['phone'];
        $oldData->user_detail->pec = $data['pec'];
        $oldData->user_detail->code_sdi = $data['code_sdi'];
        $oldData->user_detail->notes = $data['notes'];
        $oldData->user_detail->admin = $data['admin'];

        $oldData->user_detail->save();


        return redirect()
            ->route('admin.users.show', ['user' => $oldData])
            ->with('edited', $oldData['name']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id)
    : RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route('admin.users.index')
            ->with('deleted', $user['name']);
    }

    private function createUserDetail($user) {
        $user->user_detail()->create([
            'surname' => '',
            'business_name' => '',
            'notes' => '',
            'address' => '',
            'phone' => '',
            'city' => '',
            'cap' => '',
            'province' => '',
            'state' => '',
            'pec' => '',
            'code_sdi' => '',
            'admin' => 'registered'
        ]);
    }
}
