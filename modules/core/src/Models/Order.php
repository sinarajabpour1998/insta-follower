<?php

namespace Modules\Core\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "follow_count", "username", "status"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
