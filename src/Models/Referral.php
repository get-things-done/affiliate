<?php
namespace GetThingsDone\Affiliate\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'referrer_id','user_id'
    ];

    public function invite_code(string $inviteCode)
    {
        $this->referrer_id = InviteCode::findByCode( $inviteCode )->user_id;

        return $this;
    }

    public function user_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public static function findByUserId($user_id)
    {
        return self::where('user_id', $user_id)->first();
    }
}