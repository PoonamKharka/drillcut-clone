<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'firstname',
        'lastname',
        'company',
        'abn',
        'phone',
        'exising_acount_num',
        'shopify_cid',
        'parent_id',
        'email',
        'username',
        'password',
        'user_title',
        'address',
        'province',
        'city',
        'zip',
        'roles_id',
        'branch_id',
        'country',
        'otp',
        'opt_at',
        'is_super',
        'status',
        'draftorder_id',
        'cart_id',
        'verified',
        'additional_emails',
        'file_format',
        'project_id',
        'order_limit',
        'user_invite',
        'lock_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
}
