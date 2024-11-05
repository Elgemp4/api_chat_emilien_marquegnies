<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sender extends Model
{
    use HasUuids;
    
    protected $fillable = [
        "id",
        "sender",
        "_state"
    ];

    public function messages() : HasMany{ //relation avec les messages
        return $this->hasMany(Message::class);
    }
}
