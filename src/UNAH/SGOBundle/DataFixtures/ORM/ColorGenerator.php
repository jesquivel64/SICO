<?php

namespace UNAH\SGOBundle\DataFixtures\ORM;

class ColorGenerator {

    public static function generateUniqueHexColors($quantity = 10)
    {
        if ($quantity >= (254 * 254 * 254)) {
            // Don't try to generate the full set of hex colors this way.
            return false;
        }
        $colors = array();
        $quantity = (intval($quantity) == 0) ? 1 : intval($quantity);
        for ($i = 0; $i < $quantity; $i++) {
            $color = sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            while (in_array($color, $colors)) {
                //echo $i.': '.$color.' already existed<br />'; // uncomment to debug
                $color = sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            }
            if(in_array($color, array('FFFFFF', '000000'))){
                $i--;
                continue;
            }
            $colors[] = '#'.$color;
        }
        return $colors;
    }
}
