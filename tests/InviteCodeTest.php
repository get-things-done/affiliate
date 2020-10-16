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
        $inviteCode = InviteCode::createByUserId(1);

        $this->assertInstanceOf(InviteCode::class, $inviteCode);
        $this->assertEquals(1, $inviteCode->user_id);
        $this->assertTrue(InviteCode::findByUserId(1)->is($inviteCode));
    }

    /** @test */
    public function get_user_invite_code_when_have_no_code()
    {
        $code = app(Affiliate::class)->getUserInviteCode(1);

        $this->assertEquals(13, strlen($code));
    }
}
