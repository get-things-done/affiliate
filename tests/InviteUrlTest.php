<?php
namespace GetThingsDone\Affiliate\Tests;

use GetThingsDone\Affiliate\Affiliate;
use GetThingsDone\Affiliate\Models\Referral;

class InviteUrlTest extends TestCase
{

    /** @test */
    public function it_should_store_invite_code_to_session()
    {
        $inviteCode = Affiliate::getInviteCode($this->getUserId(1));
        $inviteUrl = Affiliate::getInviteUrl($this->getUserId(1));

        $this->assertStringContainsString($inviteCode, $inviteUrl);

        $this->get($inviteUrl)
            ->assertRedirect('/register')
            ->assertSessionHas([
                'invite_code' => (string) $inviteCode,
            ]);
    }

    /** @test */
    public function it_should_get_empty_referral_when_never_click_invite_url()
    {
        $inviteCode = Affiliate::getInviteCode($this->getUserId(1));

        $referral = Affiliate::getReferral($this->getUserId(2));

        $this->assertNull($referral);
    }

    /** @test */
    public function it_should_get_referral_when_have_did_not_store_but_have_invite_code_in_session()
    {
        $inviteCode = Affiliate::getInviteCode($this->getUserId(1));

        session([
            'invite_code' => (string) $inviteCode,
        ]);
        
        $referral = Affiliate::getReferral($this->getUserId(2));

        $this->assertInstanceOf(Referral::class, $referral);
        $this->assertEquals($this->getUserId(1), $referral->referrer_id);
    }

    /** @test */
    public function it_should_get_referral_when_have_record_in_database()
    {
        $inviteCode = Affiliate::getInviteCode($this->getUserId(1));

        Referral::create([
            'referrer_id' => $this->getUserId(1),
            'user_id' => $this->getUserId(2),
        ]);

        $referral = Affiliate::getReferral($this->getUserId(2));
        
        $this->assertInstanceOf(Referral::class, $referral);
        $this->assertEquals($this->getUserId(1), $referral->referrer_id);
    }
}
