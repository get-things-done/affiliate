<?php
namespace GetThingsDone\Affiliate;

use GetThingsDone\Affiliate\Models\Referral;
use GetThingsDone\Affiliate\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetRefferalsByLevelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_referrers_from_user_id()
    {
        Referral::insert([
            [
                'referrer_id' => 1,
                'user_id' => 2,
            ],
            [
                'referrer_id' => 1,
                'user_id' => 3,
            ],
            [
                'referrer_id' => 2,
                'user_id' => 4,
            ],
            [
                'referrer_id' => 2,
                'user_id' => 5,
            ],
            [
                'referrer_id' => 3,
                'user_id' => 6,
            ],
            [
                'referrer_id' => 3,
                'user_id' => 7,
            ],
        ]);
        
        $network = Affiliate::getNetwork(1);

        $this->assertEquals(2, $network->getByLevel(1)->count());
        $this->assertEquals(4, $network->getByLevel(2)->count());
    }
}
