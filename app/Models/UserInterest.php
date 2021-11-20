<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    use HasFactory;
    protected $table = "user_interests";
    protected $fillable = [
        'submitted_by_id',
        'submitted_for_id',
        'is_interested',
    ];
    public function submittedBy ()
    {
        return $this->belongsTo('App\Models\User','submitted_by_id');
    }
    public function submittedFor ()
    {
        return $this->belongsTo('App\Models\User','submitted_for_id');
    }
}
