<?php

namespace GetThingsDone\Affiliate;

use GetThingsDone\Affiliate\Models\InviteCode;
use GetThingsDone\Affiliate\Models\Referral;

class Affiliate
{
    public static function getInviteCode($user_id): InviteCode
    {
        $inviteCode = InviteCode::findByUserId($user_id);

        if (empty($inviteCode)) {
            $inviteCode = InviteCode::createByUserId($user_id);
        }

        return $inviteCode;
    }

    public static function getInviteUrl($user_id)
    {
        $inviteCode = self::getInviteCode($user_id);

        return url("/r/$inviteCode");
    }

    public static function getReferral($user_id): ?Referral
    {
        $referral = Referral::findByUserId($user_id);

        if (! $referral && session()->has('invite_code')) {
            $referral = (new Referral)
                            ->invite_code(session()->get('invite_code'))
                            ->user_id($user_id);
            $referral->save();
        }


        return $referral;
    }

    public static function getNetwork($user_id, $maxLevel = 2): Network
    {
        return Network::of($user_id)->maxLevel($maxLevel)->build();
    }
}
