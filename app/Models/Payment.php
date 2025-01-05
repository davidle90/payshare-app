<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_id',
        'group_id',
        'label',
        'total',
        'created_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function group() : BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function contributors() : HasMany
    {
        return $this->hasMany(Contributor::class, 'payment_id', 'id');
    }

    public function participants() : HasMany
    {
        return $this->hasMany(Participant::class, 'payment_id', 'id');
    }
}
