<?php

namespace App\Repositories;

abstract class Repository
{
    /**
     * Getting all data of model.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model()->all();
    }

    abstract public function model();

    /**
     * Getting model data by given id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->model()->find($id);
    }

    /**
     * Getting data by given columns and conditions, orders.
     *
     * @param null $where
     * @param null $orders
     * @param null $columns
     *
     * @return array
     */
    public function get($where = null, $orders = null, $columns = null)
    : array
    {
        $query = $this->model();

        if (!empty($columns)) {
            $query = $query->select($columns);
        }

        if (!empty($where)) {
            $query = $query->where($where);
        }

        if (!empty($orders)) {
            if (is_array($orders)) {
                foreach ($orders as $order) {
                    $query = is_array($order) ? $query->orderBy($order[0], $order[1]) : $query->orderBy($order);
                }
            } else {
                $query = $query->orderBy($orders);
            }
        }

        return $query->get();
    }
}
