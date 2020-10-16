<?php

namespace GetThingsDone\Affiliate;

use GetThingsDone\Affiliate\Models\InviteCode;

class Affiliate
{
    public function getUserInviteCode($user_id)
    {
        $inviteCode = InviteCode::findByUserId($user_id);

        if (empty($inviteCode)) {
            $inviteCode = InviteCode::createByUserId($user_id);
        }

        return $inviteCode;
    }
}
