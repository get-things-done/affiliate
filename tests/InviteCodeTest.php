<?php

namespace GetThingsDone\Affiliate\Tests;

use GetThingsDone\Affiliate\Affiliate;
use GetThingsDone\Affiliate\Models\InviteCode;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InviteCodeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function create_by_user_id()
    {
        $inviteCode = InviteCode::createByUserId($this->getUserId(1));

        $this->assertInstanceOf(InviteCode::class, $inviteCode);
        $this->assertEquals($this->getUserId(1), $inviteCode->user_id);
        $this->assertTrue(InviteCode::findByUserId($this->getUserId(1))->is($inviteCode));
        $this->assertTrue(InviteCode::findByCode($inviteCode)->is($inviteCode));
    }

    /** @test */
    public function get_user_invite_code_when_have_no_code()
    {
        $code = Affiliate::getInviteCode($this->getUserId(1));

        $this->assertEquals(13, strlen($code));
    }
}
