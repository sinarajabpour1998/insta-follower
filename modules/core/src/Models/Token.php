<?php

namespace Modules\Core\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "token", "status", "expires_at"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
