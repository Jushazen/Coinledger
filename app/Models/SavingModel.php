<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingModel extends Model
{
    use HasFactory;

    protected $table = 'savings';
    protected $primaryKey = 'saving_id';

    protected $fillable = [
        'user_id',
        'saving_name',
        'saved',
        'monthly',
        'target_amount', // Added
        'target_date',
        'short_description',
        'status',
    ];

    protected $casts = [
        'target_date' => 'date',
        'saved' => 'decimal:2',
        'monthly' => 'decimal:2',
        'target_amount' => 'decimal:2', // Added
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'saving_id';
    }
}
