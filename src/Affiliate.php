<?php

namespace GetThingsDone\Affiliate;

use GetThingsDone\Affiliate\Models\Referral;
use GetThingsDone\Affiliate\Models\InviteCode;

class Affiliate
{
    public function getInviteCode($user_id): InviteCode
    {
        $inviteCode = InviteCode::findByUserId($user_id);

        if (empty($inviteCode)) {
            $inviteCode = InviteCode::createByUserId($user_id);
        }

        return $inviteCode;
    }

    public function getInviteUrl($user_id)
    {
        $inviteCode = $this->getInviteCode($user_id);

        return url("/r/$inviteCode");
    }

    public function getReferral($user_id): ?Referral
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
}
