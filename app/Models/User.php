<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    public const CLIENT = 0;
    public const USER = 0;
    public const ADMIN = 1;
    public const COLLABORATOR = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone',
        'role',
        'balance',
        'avatar',
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
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }

    public function GameAccount()
    {
        return $this->hasMany(GameAccount::class);
    }

    public function BillAccount()
    {
        return $this->hasMany(AccountBill::class);
    }

    public function BillRecharge()
    {
        return $this->hasMany(RechargeBill::class);
    }

    public function RerollBill()
    {
        return $this->hasMany(RerollBill::class);
    }

    public function BalanceRechargeBankBill()
    {
        return $this->hasMany(BalanceRechargeBankBill::class);
    }

    public function BalanceRechargeCardBill()
    {
        return $this->hasMany(BalanceRechargeCardBill::class);
    }

    public function CollaboratorCommissionBill()
    {
        return $this->hasMany(CollaboratorCommissionBill::class, 'collaborator_id');
    }

    // public function ContributorCommission()
    // {
    //     return $this->hasMany(ContributorCommission::class);
    // }
}
