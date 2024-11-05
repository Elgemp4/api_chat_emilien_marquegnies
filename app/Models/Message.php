<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasUuids;

    protected $fillable = [ //Champs remplissalbe
        "sender_id",
        "content",
        "_state"
    ];

    public function sender() : HasOne { //Relation avec le sender
        return $this->hasOne(Sender::class);
    }
}
