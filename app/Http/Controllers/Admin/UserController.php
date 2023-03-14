<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\Repositories\UserRepository;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * 👉 Display user's list
     *
     * @param Request $request
     *
     * @return Application|Factory|View|mixed
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAllUsersWithDetail($request);
        }

        $tableColumns = [
            ['label' => 'ID', 'class' => 'text-center'],
            ['label' => 'Ruolo', 'class' => 'text-center'],
            ['label' => 'Nome', 'class' => 'text-center'],
            ['label' => 'Mail', 'class' => 'text-center'],
            ['label' => 'Telefono', 'class' => 'text-center'],
            ['label' => 'Impostazioni', 'class' => 'no-sort display-none unsettled-cols text-center']
        ];

        return view('admin.users.index', compact('tableColumns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = UserDetail::select('admin')->distinct()->get();

        return view('admin.users.create', compact('roles'));
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

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email',
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

        $user = new User();

        $this->repository->saveUser($user, $data, true);

        return redirect()
            ->route('admin.users.show', ['user' => $user->id])
            ->with('created', $data['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        if (!$user->user_detail) {
            $this->repository->createUserDetail($user);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        if (!$user->user_detail) {
            $this->repository->createUserDetail($user);
        }

        $roles = UserDetail::select('admin')->distinct()->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     *
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    : RedirectResponse
    {
        $data = $request->all();

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,' . $user->id,
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

        $this->repository->saveUser($user, $data, false);

        return redirect()
            ->route('admin.users.show', ['user' => $user->id])
            ->with('edited', $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    : RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('deleted', $user['name']);
    }
}
