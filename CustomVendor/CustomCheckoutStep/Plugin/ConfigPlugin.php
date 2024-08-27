<?php

namespace CustomVendor\CustomCheckoutStep\Plugin;

class ConfigPlugin
{
    public function afterIsSetFlag(\Magento\Framework\App\Config\ScopeConfigInterface $subject, $result, $path)
    {
        if ($path == 'customcheckoutstep/settings/enable') {
            return (bool)$result;
        }

        return $result;
    }
}
