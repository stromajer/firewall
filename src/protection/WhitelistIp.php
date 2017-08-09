<?php

namespace karster\security\protection;

use Longman\IPTools\Ip;

class WhitelistIp extends Rule implements RuleInterface
{
    public function protect()
    {
        $ip = $this->getIp();
        $rules = $this->getRules();

        if (!empty($ip) && !empty($rules)) {
            foreach ($rules as $rule) {
                if (Ip::match($ip, $rule)) {
                    return true;
                }
            }
        }

        return false;
    }
}