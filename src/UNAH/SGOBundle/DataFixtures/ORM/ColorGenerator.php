<?php

namespace UNAH\SGOBundle\DataFixtures\ORM;

class ColorGenerator {
    
    public static function generateUniqueHexColors($quantity = 10)
    {    
        $source = array(
            '#8B8989', '#8B6969', '#BC8F8F', '#C67171', '#CD5555', '#8E2323',
            '#CC3232', '#8B1A1A', '#DB2929', '#EE6363', '#330000', '#8B0000',
            '#FF0000', '#FF4040', '#FFC1C1', '#A02422', '#F2473F', '#CDB7B5',
            '#FC1501', '#FA8072', '#D66F62', '#8A3324', '#FF5333', '#8B3E2F',
            '#EE6A50', '#D43D1A', '#FF3D0D', '#C73F17', '#A78D84', '#5E2612',
            '#CD3700', '#FF7F50', '#EE9572', '#FFA07A', '#A0522D', '#EE7942',
            '#8B4726', '#993300', '#97694F', '#FF6103', '#FF7722', '#733D1A',
            '#FF9955', '#E9C2A6', '#8B4513', '#BC7642', '#C76114', '#EE8833',
            '#8B7765', '#F4A460', '#B87333', '#FFA54F', '#CD7F32', '#CC7722',
            '#EE7600', '#FFCC99', '#B67C3D', '#E38217', '#9F703A', '#EDC393',
            '#DD7500', '#8B7355', '#ED9121', '#CDAA7D', '#C48E48', '#EEC591',
            '#8B8378', '#8B795E', '#DC8909', '#AA6600', '#FFDEAD', '#EED6AF',
            '#CDBA96', '#EE9A00', '#D5B77A', '#FFAA00', '#E8C782', '#FEE5AC',
            '#DAA520', '#EEB422', '#CD950C', '#E6B426', '#CDAB2D', '#EEDC82',
            '#8B8878', '#EEDD82', '#EEC900', '#FBDB0C', '#FFE303', '#D6C537',
            '#FFE600', '#8B864E', '#EEE685', '#BDB76B', '#7B7922', '#8B8B83',
            '#CDCDC1', '#4F4F2F', '#777733', '#D9D919', '#8B8B00', '#EEEE00',
            '#FFFFAA', '#98A148', '#AEBB51', '#B3C95A', '#668014', '#54632C',
            '#D4ED91', '#A2C257', '#79973F', '#9ACD32', '#DFFFA5', '#A2CD5A',
            '#ADFF2F', '#CDC9C9', '#856363', '#CD9B9B', '#802A2A', '#A52A2A',
            '#A62A2A', '#EEB4B4', '#B22222', '#8C1717', '#EE3B3B', '#660000',
            '#CD0000', '#FF3030', '#FF6666', '#C65D57', '#E3170D', '#AF4035',
            '#CC1100', '#C75D4D', '#CD4F39', '#FF6347', '#8B3626', '#FF7256',
            '#F5785A', '#8B4C39', '#EE8262', '#E9967A', '#E04006', '#EE4000',
            '#8B5742', '#B13E0F', '#5C4033', '#CD6839', '#FF7D40', '#DB9370',
            '#F87531', '#5E2605', '#964514', '#6B4226', '#FF6600', '#A68064',
            '#CD661D', '#EE7621', '#CDC5BF', '#603311', '#FA9A50', '#CDAF95',
            '#FFDAB9', '#EE9A49', '#E7C6A5', '#CC7F32', '#8B4500', '#FF8000',
            '#C9AF94', '#C77826', '#7B3F00', '#EBCEAC', '#E18E2E', '#FF8600',
            '#EED5B7', '#FF8C00', '#8B7D6B', '#D2B48C', '#DEB887', '#FF9912',
            '#B28647', '#CDB38B', '#FCD59C', '#FFA824', '#8B7E66', '#8B5A00',
            '#FFA500', '#8E6B23', '#FFB00F', '#F0A804', '#FFB90F', '#8B6914',
            '#8B6508', '#EEAD0E', '#EDCB62', '#FFCC11', '#C6C3B5', '#CFB53B',
            '#8B814C', '#FCDC3B', '#C5C1AA', '#8B7500', '#FFD700', '#E2DDB5',
            '#CDC9A5', '#F0E68C', '#CDC673', '#FFF68F', '#E0D873', '#CBCAB6',
            '#CECC15', '#8B8B7A', '#CDCDB4', '#9F9F5F', '#8E8E38', '#CDCD00',
            '#FFFF00', '#F4F776', '#CFD784', '#D0D2C4', '#859C27', '#C8F526',
            '#AADD00', '#8BA446', '#BEE554', '#6B8E23', '#B3EE3A', '#556B2F',
            '#BCEE68', '#385E0F', '#6F4242', '#8B3A3A', '#CD5C5C', '#8B2323',
            '#CD3333', '#BE2625', '#CD2626', '#F08080', '#EE2C2C', '#800000',
            '#EE0000', '#FF3333', '#FF6A6A', '#D44942', '#9D1309', '#ECC3BF',
            '#EED5D2', '#8B7D7B', '#FF2400', '#EE5C42', '#B0A6A4', '#CD5B45',
            '#B3432B', '#FF3300', '#CD7054', '#FF8C69', '#FF5721', '#8B2500',
            '#FF4500', '#CD8162', '#691F01', '#D19275', '#8A360F', '#FF8247',
            '#87421F', '#FBA16C', '#E47833', '#5C3317', '#FF7216', '#855E42',
            '#D2691E', '#FF7F24', '#E3701A', '#8B8682', '#B6AFA9', '#EECBAD',
            '#8B5A2B', '#AA5303', '#CD853F', '#CD6600', '#FF7F00', '#E3A869',
            '#CDB79E', '#EBC79E', '#C76E06', '#CDC0B0', '#DFAE74', '#FFE4C4',
            '#A39480', '#EEDFCC', '#9C661F', '#D98719', '#FFD39B', '#734A12',
            '#EECFA1', '#FFC469', '#A67D3D', '#FFA812', '#8C7853', '#CD8500',
            '#AC7F24', '#FCB514', '#9D8851', '#CD9B1D', '#B8860B', '#FFC125',
            '#E5BC3B', '#E0DFDB', '#CDC8B1', '#FCD116', '#CDBE70', '#FFEC8B',
            '#E3CF57', '#CDAD00', '#B5A642', '#F3E88E', '#FBEC5D', '#615E3F',
            '#8B8970', '#BAAF07', '#EEEB8D', '#3A3A38', '#808069', '#D8D8BF',
            '#DBDB70', '#808000', '#CCCC00', '#FFFF7E', '#CDD704', '#D1E231',
            '#A2BC13', '#CDE472', '#414F12', '#BCE937', '#A2C93A', '#9CCB19',
            '#698B22', '#99CC32', '#C0FF3E', '#6E8B3D', '#CAFF70'
        );
        
        if ($quantity >= count($source)) {
            return false;
        }
        
        $colors = array();
        $quantity = (intval($quantity) == 0) ? 1 : intval($quantity);
        for ($i = 0; $i < $quantity; $i++) {
            $choice = mt_rand(0, count($source));
            while (in_array($source[$choice], $colors)) {
                $choice = mt_rand(0, count($source));
            }
            $colors[] = $source[$choice];
        }
        return $colors;
    }
}
