<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

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

    public function ContributorCommission()
    {
        return $this->hasMany(ContributorCommission::class);
    }
}
