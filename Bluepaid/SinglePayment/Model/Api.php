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
Class Bluepaid_SinglePayment_Model_Api {
	
	// **************************************
	// PROPERTIES
	// **************************************
	/**
	 * The fields to send to the Bluepaid platform
	 * @var array[string]BluepaidField
	 * @access private
	 */
	var $requestParameters;
	/**
	 * Certificate to send in TEST mode
	 * @var string
	 * @access private
	 */
	var $keyTest;
	/**
	 * Certificate to send in PRODUCTION mode
	 * @var string
	 * @access private
	 */
	var $keyProd;
	/**
	 * Url of the payment page
	 * @var string
	 * @access private
	 */
	var $platformUrl;
	/**
	 * Set to true to send the redirect_* parameters
	 * @var boolean
	 * @access private
	 */
	var $redirectEnabled;
	/**
	 * SHA-1 authentication signature
	 * @var string
	 * @access private
	 */
	var $signature;
	/**
	 * Raw response sent by the platform
	 * @var BluepaidResponse
	 * @access private
	 * @deprecated see BluepaidResponse constructor
	 */
	var $response;
	/**
	 * The original data encoding.
	 * @var string
	 * @access private
	 */
	var $encoding;
	
	
	/**
	 * @var string
	 */
	 protected $_wsdl;
   /**
	 * @var SoapClient
	 */
	 public $_client;
   
	 /**
	  * provide the wsdl and endpoint so we can construct the soap object.
	  * @param string $wsdl
	  */
	  //token provided by bluepaid api when communicating back to magento.
	  public $_apiToken = null;
  
  
	 public function Bluepaid_SinglePayment_Model_Api(){
		 
	  }
	  
	  public function _getTokenApi(){
		  $this->log('Start');
		  $this->log('Called custom ' . __METHOD__);			
		  $token = $this->_getApiToken();
		  $this->log('token => '.$token);
		  $this->log('End');
		  return $token;
	  }
	  
	  public function _setApiToken($numStr=10){	
		  $this->log('Start');
		  $this->log('Called custom ' . __METHOD__);	
		  $uId='';
			srand( (double)microtime()*rand(1000000,9999999) ); // Genere un nombre aléatoire
			$arrChar = array(); // Nouveau tableau
		
			for( $i=65; $i<90; $i++ ) {
				array_push( $arrChar, chr($i) ); // Ajoute A-Z au tableau
				array_push( $arrChar, strtolower( chr( $i ) ) ); // Ajouter a-z au tableau
			}
		
			for( $i=48; $i<57; $i++ ) {
				array_push( $arrChar, chr( $i ) ); // Ajoute 0-9 au tableau
			}
		
			for( $i=0; $i< $numStr; $i++ ) {
				$uId .= $arrChar[rand( 0, count( $arrChar ) )]; // Ecrit un aléatoire
			}		   
		   $this->_apiToken=$uId;
		   $_SESSION["bluepaidApiToken"] = $uId;
		   return $uId;
	  }
    
	  protected function _getApiToken(){
		  $sessionToken=$_SESSION["bluepaidApiToken"];
		  return $sessionToken;
	  }
	  
	
		/**
		 * Returns a configuration parameter from xml files
		 * @param $name the name of the parameter to retrieve
		 * @return array code=>name
		 */
		public function getConfigModeArray($name="") {
			$result = array();
			$result['TEST'] = 'Test';
			$result['PRODUCTION'] = 'Production';
			return $result;
		}
		
		public function Is_testMode(){		
			$istest_mode=$this->getModel()->getConfigData('bpixt_mode');
			if($istest_mode=='Test')return true;
			return false;
		}
		
		public function Is_authorizedIp($ip=''){
			$this->log('Start');
			$this->log('Call to '.__METHOD__);
			$ipaddressbpi=$this->getModel()->getConfigData('ipaddressbpi');
			$this->log('GET => '.$ipaddressbpi);
			if($ip){
				if($ipaddressbpi){
					$this->log('recup OK');
					if($ipaddressbpi!=''){
						$this->log('recup OK (2)');
						$ipaddressbpi=explode(';', $ipaddressbpi);
						if(is_array($ipaddressbpi)){
							foreach($ipaddressbpi as $key=>$value){
								$this->log('Authorized IP => '.$value);
								if($value == $ip){
									$this->log('Ok, tested IP => '.$ip);
									return true;
								}
							}
						}elseif($ipaddressbpi==$ip){
							$this->log('Authorized IP => '.$ipaddressbpi);
							$this->log('Ok, tested IP => '.$ip);
							return true;
						}
						$this->log('Unuthorized IP => '.$ip);
						return false;
					}				
				}
			}
			$this->log('NO IP => '.$ip);
			$this->log('END'); return true;
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
    function getModel() {
    	return Mage::getModel('bluepaid/standard');
    }
}