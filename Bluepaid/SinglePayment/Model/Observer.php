<?php
#####################################################################################################
#
#					Module pour la plateforme de paiement Bluepaid
#						Version : 0.1 
#									########################
#					Développé pour Magento
#						Version : 1.7.0.X
#						Compatibilité plateforme : V2
#									########################
#					Développé par Bluepaid
#						http://www.bluepaid.com/
#						22/02/2013
#						Contact : support@bluepaid.com
#
#####################################################################################################
class Bluepaid_SinglePayment_Model_Observer
{   
    public function saveOrderQuoteToSession($observer){
        /* @var $event Varien_Event */
        $event = $observer->getEvent();
        /* @var $order Mage_Sales_Model_Order */
        $order = $event->getOrder();
        /* @var $quote Mage_Sales_Model_Quote */
        $quote = $event->getQuote();
              
        $session = Mage::getSingleton('checkout/session');
        $quoteId = $quote->getId();
        $orderId = $order->getId();
        $incrId = $order->getIncrementId();
        Mage::log("Saving quote  [$quoteId] and order [$incrId] to checkout/session");

        $session->setData('apiOrderId',$orderId);
        $session->setData('apiOrderIncrementId',$incrId);
        
        unset($event);
        unset($order);
        unset($quote);
        unset($session);
        
        return $this;
    }
}