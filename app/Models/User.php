<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'reference_id',
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function groups_created() : HasMany
    {
        return $this->hasMany(Group::class, 'owner_id', 'id',);
    }

    public function groups() : BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_member', 'member_id', 'group_id');
    }

    public function contributions() : HasMany
    {
        return $this->hasMany(Contributor::class, 'member_id', 'id');
    }

    public function participations() : HasMany
    {
        return $this->hasMany(Participant::class, 'member_id', 'id');
    }

    public function debtsOwedToMe()
    {
        $debtsOwedToMe = $this->hasMany(Debt::class, 'to_user_id');

        $debts = $debtsOwedToMe->whereHas('group', function ($q) {
            $q->where('is_resolved', false);
        });

        return $debts;
    }

    public function debtsIOwe()
    {
        $debtsIOwe = $this->hasMany(Debt::class, 'from_user_id');

        $debts = $debtsIOwe->whereHas('group', function ($q) {
            $q->where('is_resolved', false);
        });

        return $debts;
    }
}
