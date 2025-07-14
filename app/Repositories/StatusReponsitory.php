<?php

namespace App\Repositories;

use App\Models\Status;
use Exception;

class StatusRepository
{
    /**
     * Get all statuses.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllStatuses()
    {
        return Status::all();
    }

    /**
     * Get a specific status by ID.
     *
     * @param int $id
     * @return \App\Models\Status|null
     */
    public function getStatusById($id)
    {
        return Status::find($id);
    }

    /**
     * Create a new status.
     *
     * @param array $data
     * @return \App\Models\Status
     */
    public function createStatus(array $data)
    {
        return Status::create($data);
    }

    /**
     * Update an existing status.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateStatus($id, array $data)
    {
        $status = $this->getStatusById($id);

        if ($status) {
            return $status->update($data);
        }

        return false;
    }

    /**
     * Delete a status.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteStatus($id)
    {
        $status = $this->getStatusById($id);

        if ($status) {
            return $status->delete();
        }

        return false;
    }
}
