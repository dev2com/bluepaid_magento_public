<?php
#####################################################################################################
#
#					Module pour la plateforme de paiement Bluepaid
#						Version : 0.1 
#									########################
#					Développé pour Magento
#						Version : 1.7.1.0
#						Compatibilité plateforme : V2
#									########################
#					Développé par Bluepaid
#						http://www.bluepaid.com/
#						22/02/2013
#						Contact : support@bluepaid.com
#
#####################################################################################################

class Bluepaid_SinglePayment_Model_Source_BpiModes
{
    public function toOptionArray()
    {
        $options =  array();

        foreach (Mage::getSingleton('bluepaid/api')->getConfigModeArray('bpixt_mode') as $name => $code)
		{
            $options[] = array
			(
               'value' => $code,
               'label' => $name
            );
        }

        return $options;
    }
}