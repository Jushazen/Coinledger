<?php

// app/Models/FundModel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundModel extends Model
{
    use HasFactory;

    protected $table = 'funds';
    protected $primaryKey = 'fund_id';

    protected $fillable = [
        'user_id',
        'fund_name',
        'your_contribution',
        'contributed_on',
        'collected',
        'short_description',
        'status',
    ];

    protected $casts = [
        'contributed_on' => 'date',
        'your_contribution' => 'decimal:2',
        'collected' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Route model binding
    public function getRouteKeyName()
    {
        return 'fund_id';
    }
}
