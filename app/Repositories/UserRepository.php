<?php

namespace App\Repositories;

use App\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserRepository extends Repository
{
    public function model()
    {
        return app(User::class);
    }

    private function getUsersDataQuery()
    {
        return $this->model()
            ->select(
                'users.*',
                'user_details.admin',
                'user_details.phone'
            )
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->with(['user_detail']);
    }

    /**
     * 👉 Get all user's data with details
     *
     * @return mixed
     * @throws Exception
     */
    public function getAllUsersWithDetail($request)
    {
        $query = $this->getUsersDataQuery();

        return DataTables::of($query)
            ->editColumn('admin', function ($user) {
                return $user->user_detail && $user->user_detail->admin ? $user->user_detail->admin : '';
            })
            ->editColumn('phone', function ($user) {
                return $user->user_detail && $user->user_detail->phone ? $user->user_detail->phone : '';
            })
            ->addColumn('action', function ($user) {
                $actionStr = '<div class="d-flex justify-content-center align-items-center">';
                $actionStr .= '<a class="btn btn-sm btn-success rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.users.show', ['user' => $user->id]) . '">';
                $actionStr .= '<i class="fas fa-eye"></i></a>';

                $actionStr .= '<a class="btn btn-sm btn-primary rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.users.edit', ['user' => $user->id]) . '">';
                $actionStr .= '<i class="fas fa-edit"></i></a>';

                $actionStr .= '<form action="' . route('admin.users.destroy', ['user' => $user->id]) . '" ';
                $actionStr .= ' method="post" class="d-inline">';
                $actionStr .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $actionStr .= '<input type="hidden" name="_method" value="DELETE">';
                $actionStr .= '<button type="submit" class="btn-sm btn-danger rounded-circle">';
                $actionStr .= '<i class="fas fa-trash"></i></button>';
                $actionStr .= '</div>';

                return $actionStr;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * 👉 Create or Update user's data
     *
     * @param $user
     * @param $data
     * @param $create
     *
     * @return void
     */
    public function saveUser(&$user, $data, $create)
    {
        $user->name = $data['name'] ?: '';
        $user->email = $data['email'] ?: '';
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        if ($create) {
            $this->createUserDetail($user);
        } else {
            $this->saveUserDetail($user, $data);
        }
    }

    /**
     * 👉 Update user's detail
     *
     * @param $user_id
     * @param $params
     *
     * @return void
     */
    public function updateUserDetails($user_id, $params)
    {
        if (isset($params['user_detail'])) {
            $user = $this->model()->with('user_detail')->where('id', $user_id)->first();

            $data = $params['user_detail'];
            $data['admin'] = 'registered';

            $this->saveUserDetail($user, $data);
        }
    }

    /**
     * 👉 Create blank user detail info
     *
     * @param $user
     *
     * @return void
     */
    public function createUserDetail(&$user)
    {
        $user->user_detail()->create([
            'surname'       => '',
            'business_name' => '',
            'notes'         => '',
            'address'       => '',
            'phone'         => '',
            'city'          => '',
            'cap'           => '',
            'province'      => '',
            'state'         => '',
            'pec'           => '',
            'code_sdi'      => '',
            'admin'         => 'registered',
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        $user->user_detail = $user->user_detail()->first();
    }

    /**
     * 👉 Get user's added cart items
     *
     * @param User $user
     *
     * @return Collection
     */
    public function getCartItems(User $user)
    : Collection
    {
        return $user->products()->get()->map(function ($product) {
            $category = $product->category;
            $subcategory = $product->subcategory;

            $product->cart_quantity = $product->pivot->quantity;
            $product->category = $category;
            $product->subcategory = $subcategory;

            return $product;
        });
    }

    /**
     * 👉 Update user's detail
     *
     * @param $user
     * @param $data
     *
     * @return void
     */
    private function saveUserDetail(&$user, $data)
    {
        $saveData = [
            'surname'       => $data['surname'] ?: '',
            'business_name' => $data['business_name'] ?: '',
            'notes'         => $data['address'] ?: '',
            'address'       => $data['cap'] ?: '',
            'phone'         => $data['city'] ?: '',
            'city'          => $data['province'] ?: '',
            'cap'           => $data['state'] ?: '',
            'province'      => $data['phone'] ?: '',
            'state'         => $data['pec'] ?: '',
            'pec'           => $data['code_sdi'] ?: '',
            'code_sdi'      => $data['notes'] ?: '',
            'admin'         => $data['admin'] ?: 'registered',
            'updated_at'    => now()
        ];

        if (!$user->user_detail) {
            $saveData['created_at'] = now();

            $user->user_detail()
                ->create($saveData);
        } else {
            $user->user_detail()
                ->update($saveData);
        }

        $user->user_detail = $user->user_detail()->first();
    }
}
