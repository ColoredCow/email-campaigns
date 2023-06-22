<?php

namespace App\Models;

use App\Models\Attachment;
use App\Models\SenderIdentity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Campaign extends Model
{
    protected $fillable = [
        'subscription_list_id',
        'sender_identity_id',
        'email_subject',
        'email_body',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'subscription_list_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'resource');
    }

    public function senderIdentity()
    {
        return $this->hasOne(SenderIdentity::class, 'id', 'sender_identity_id');
    }

    public function senderIdentityName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['senderIdentity'] ? $attributes['senderIdentity']->name : config('constants.campaigns.from.name'),
        );
    }

    public function senderIdentityEmail(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['senderIdentity'] ? $attributes['senderIdentity']->email : config('constants.campaigns.from.email'),
        );
    }
}
