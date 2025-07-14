<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;


class Manager extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    /**
     * The table associated with the model.
     */
    protected $table = 'managers';

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'hired_at' => 'datetime',
        'salary' => 'decimal:2',
    ];

    /**
     * Get the hotel that the manager belongs to.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the manager's full address.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
        return $this->address ?: 'N/A';
    }

    /**
     * Get the formatted salary with currency.
     *
     * @return string
     */
    public function getFormattedSalaryAttribute(): string
    {
        return '$' . number_format($this->salary, 2);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
