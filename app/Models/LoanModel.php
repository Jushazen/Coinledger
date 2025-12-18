<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanModel extends Model
{
    use HasFactory;

    protected $table = 'loans';
    
    protected $primaryKey = 'loan_id';
    
    protected $fillable = [
        'user_id',
        'loan_name',
        'role',
        'person_name',
        'amount',
        'due_date',
        'paid',
        'short_description',
    ];
    
    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'paid' => 'decimal:2',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}