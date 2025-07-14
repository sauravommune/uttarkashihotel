<?php

namespace App\Repositories;

use App\Models\Manager;

class ManagerRepository extends BaseRepository
{
    protected $model;

    /**
     * ManagerRepository constructor.
     *
     * @param \App\Models\Manager $model
     */
    public function __construct(Manager $model)
    {
        $this->model = $model;
    }

    /**
     * Get all managers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a manager by ID.
     *
     * @param int $id
     * @return \App\Models\Manager|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new manager.
     *
     * @param array $data
     * @return \App\Models\Manager
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a manager by ID.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Manager
     */
    public function update(int $id, array $data)
    {
        $manager = $this->find($id);
        if ($manager) {
            $manager->update($data);
            return $manager;
        }

        return null;
    }

    /**
     * Delete a manager by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $manager = $this->find($id);
        if ($manager) {
            return $manager->delete();
        }

        return false;
    }
}
