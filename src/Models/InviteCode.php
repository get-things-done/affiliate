<?php
namespace GetThingsDone\Affiliate\Models;

use Illuminate\Database\Eloquent\Model;

class InviteCode extends Model
{
    protected $fillable = [
        'user_id', 'code',
    ];

    public static function findByUserId($user_id): ?self
    {
        return self::where('user_id', $user_id)->first();
    }

    public static function findByCode(string $code): ?self
    {
        return self::where('code', $code)->first();
    }

    public static function createByUserId($user_id): self
    {
        do {
            $code = strtoupper( uniqid() );
            usleep(1000);
        } while (self::where('code', $code)->exists());

        return self::create(
            compact('user_id', 'code')
        );
    }

    public function __toString()
    {
        return $this->code;
    }
}
