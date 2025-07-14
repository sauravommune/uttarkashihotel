<?php

namespace App\Services;

use App\Models\BookingRemarks;

class LeadRemarkLogger
{
    /**
     * Logs the changes made to a lead.
     *
     * @param array $oldData  The old data before the update.
     * @param array $newData  The new data after the update.
     * @param int   $leadId   The ID of the lead being updated.
     * @param string $type     The type of change being logged.
     * @param string $remark   The remark being logged.
     * @param bool  $is_new   Whether the lead is new.
     * @return void
     */
    public static function logChanges(array $oldData, array $newData, int $leadId, string $type="update", string $remark='', bool $is_new = false)
    {
        $changes = [];

        unset($oldData['id'], $oldData['created_at'], $oldData['updated_at']);
        unset($newData['id'], $newData['created_at'], $newData['updated_at']);

        // Compare fields
        foreach ($newData as $key => $newValue) {
            $oldValue = $oldData[$key] ?? null;

            if ($oldValue !== $newValue && ($oldValue || $newValue)) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue,
                ];
            }
        }
        // Log changes if there are any
        if (!empty($changes) || $is_new) {
            BookingRemarks::create(
                [
                    'description'   => $remark,
                    'changes'       => $changes,
                    'remark_type'   => $type,
                    'added_by'      => auth()?->user()?->id??null,
                    'booking_id'    => $leadId
                ]
            );
        }
    }
}
