<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'description',
        'attachment',
        'status',
        'assigned_to'
    ];

    // The user who created the ticket
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The IT user assigned to handle the ticket
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
