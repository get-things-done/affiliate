<?php
namespace GetThingsDone\Affiliate;

use GetThingsDone\Affiliate\Models\Referral;

class Network
{
    protected $user_id;
    
    protected int $maxLevel = 2;

    protected array $data = [];
    
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public static function of($user_id)
    {
        return new static($user_id);
    }

    public function build()
    {
        $referrals = Referral::get();
        
        $data = [];
        for ($level = 1; $level <= $this->maxLevel; $level++) {
            $data[$level] = $referrals->whereIn('referrer_id', $user_ids ?? [$this->user_id]);

            if ($data[$level]->isEmpty()) {
                break;
            }
            
            $user_ids = $data[$level]->pluck('user_id')->toArray();
        }

        $this->data = $data;

        return $this;
    }

    public function maxLevel(int $maxLevel)
    {
        $this->maxLevel = $maxLevel;

        return $this;
    }

    public function get()
    {
        return $this->data;
    }

    public function getByLevel($level = 1)
    {
        return $this->data[$level] ?? collect([]);
    }
}
