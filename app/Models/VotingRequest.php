<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter_id',
        'booth_id',
        'voter_data'
    ];
}
