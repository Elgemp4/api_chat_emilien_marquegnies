<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasUuids;

    protected $fillable = [
        "sender_id",
        "content",
        "_state"
    ];

    public function sender() : HasOne {
        return $this->hasOne(Sender::class);
    }
}
