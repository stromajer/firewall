<?php

namespace karster\security\protection;


class AllowedGlobals extends Rule implements RuleInterface
{
    /**
     * @param array $rules
     * @return $this
     */
    public function setRules($rules)
    {
        if (!empty($rules) && is_array($rules)) {
            foreach ($rules as $rule) {
                $this->rules[] = strtoupper($rule);
            }
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function protect()
    {
        $runProtection = false;
        if (isset($GLOBALS)) {
            $rules = $this->getRules();

            foreach ($GLOBALS as $key => $value) {
                if (!in_array($key, $rules)) {
                    unset($GLOBALS[$key]);
                    $runProtection = true;
                }
            }
        }

        return $runProtection;
    }
}