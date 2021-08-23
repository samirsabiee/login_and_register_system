<?php


namespace App\Services\Auth\Traits;


use App\Models\TwoFactor;

trait HasTwoFactor
{
    public function code()
    {
        return $this->hasOne(TwoFactor::class);
    }

    public function activeTwoFactor()
    {
        $this->has_two_factor = true;
        $this->save();
    }

    public function deactivateTwoFactor()
    {
        $this->has_two_factor = false;
        $this->save();
    }
}
