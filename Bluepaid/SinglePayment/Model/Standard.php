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
class Bluepaid_SinglePayment_Model_Standard extends Mage_Payment_Model_Method_Abstract
{ 
    
    //payment method code. Used in XML config and Db.
    protected $_code = 'bluepaid';
    //flag which causes initalize() to run when checkout is completed. 
    protected $_isInitializeNeeded      = true;
    //Disable payment method in admin/order pages.
    protected $_canUseInternal          = false;
    //Disable multi-shipping for this payment module.
    protected $_canUseForMultishipping  = false;
    //token provided by bluepaid api when communicating back to magento.
    protected $_apiToken = null;
	
    /**
    * Return URL to redirect the customer to.
    * Called after 'place order' button is clicked.
    * Called after order is created and saved.
    * @return string
    */	
    public function getOrderPlaceRedirectUrl()
    {
        /* Mage log is your friend. 
         * While it shouldn't be on in production, 
         * it makes debugging problems with your api much easier.
         * The file is in magento-root/var/log/system.log
         */
		 $this->log('Start');
		return Mage::getUrl('bluepaid/standard/payment');
		 $this->log('End');
    }
	
    /**
     * 
     * <payment_action>Sale</payment_action>
     * Initialize payment method. Called when purchase is complete.
     * Order is created after this method is called.
     *
     * @param string $paymentAction
     * @param Varien_Object $stateObject
     *
     * @return Mage_Payment_Model_Abstract
     */
    public function initialize($paymentAction, $stateObject)
    {  
		##Status Order => Pending
		$this->log('Start');		 
		$this->log('Called ' . __METHOD__ . ' with payment ' . $paymentAction);
        parent::initialize($paymentAction, $stateObject);        
        //Payment is also used for refund and other backend functions.
        //Verify this is a sale before continuing.
        if($paymentAction != 'sale'){
            return $this;
        }        
        //Set the default state of the new order.
        $state = Mage_Sales_Model_Order::STATE_PENDING_PAYMENT; // state now = 'pending_payment'
        $stateObject->setState($state); 
        $stateObject->setStatus('pending_payment');
        $stateObject->setIsNotified(false);
		 
		return Mage::getUrl('bluepaid/standard/payment');    
		 $this->log('End');       
    }

	/**
	 * Log function. Uses Mage::log with built-in extra data (module version, method called...)
	 * @param $message
	 * @param $level
	 */
    protected function log($message, $level=null) {
    	$currentMethod = $this->getCallerMethod();
    	
		if (!Mage::getStoreConfig('dev/log/active')) {
    		return;
    	}

    	$log  = '';
    	$log .= 'Bluepaid 1.1 37000';
    	$log .= ' - '.$currentMethod;
    	$log .= ' : '.$message;
		Mage::log($log, $level, 'bluepaid.log');
    }
    
	protected function getCallerMethod() {
    	$traces = debug_backtrace();
    
    	if (isset($traces[2])) {
    		return $traces[2]['function'];
    	}
    
    	return null;
    }
}