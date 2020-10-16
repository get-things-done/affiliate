<?php
namespace GetThingsDone\Affiliate\Tests;

use GetThingsDone\Affiliate\AffiliateFacade;
use GetThingsDone\Affiliate\Models\Referral;

class InviteUrlTest extends TestCase
{

    /** @test */
    public function it_should_store_invite_code_to_session()
    {
        $inviteCode = AffiliateFacade::getInviteCode(1);
        $inviteUrl = AffiliateFacade::getInviteUrl(1);

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
        $inviteCode = AffiliateFacade::getInviteCode(1);

        $referral = AffiliateFacade::getReferral(2);

        $this->assertNull($referral);
    }

    /** @test */
    public function it_should_get_referral_when_have_did_not_store_but_have_invite_code_in_session()
    {
        $inviteCode = AffiliateFacade::getInviteCode(1);

        session([
            'invite_code' => (string) $inviteCode,
        ]);
        
        $referral = AffiliateFacade::getReferral(2);

        $this->assertInstanceOf(Referral::class, $referral);
        $this->assertEquals(1, $referral->referrer_id);
    }

    /** @test */
    public function it_should_get_referral_when_have_record_in_database()
    {
        $inviteCode = AffiliateFacade::getInviteCode(1);

        Referral::create([
            'referrer_id' => 1,
            'user_id' => 2,
        ]);

        $referral = AffiliateFacade::getReferral(2);
        
        $this->assertInstanceOf(Referral::class, $referral);
        $this->assertEquals(1, $referral->referrer_id);
    }
}