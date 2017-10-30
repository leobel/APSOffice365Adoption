<?php

# It is the management context of the subscription, in which a customer can manage its Office 365 Adoption.
# It must correspond to a tenant created for the subscriber in the remote application system.
require "aps/2/runtime.php";

/**
 * Class management
 * @type("http://company.example/app/Office365Adoption/management/1.0")
 * @implements("http://aps-standard.org/types/core/subscription/service/1.0")
 */

class management extends \APS\ResourceBase
{
    ## Strong relation (link) to the application instance
    
    /**
     * @link("http://company.example/app/Office365Adoption/application/1.0")
     * @required
     */
    public $application;
    
    ## Subscription Status
    /**
     * @type("string")
     * @title("status")
     * @description("Subscription Status")
     * @readonly
     * @required
     */
    public $status;
    
    /**
     * @verb(GET)
     * @path("/status")
     * @access(admin, true)
     * @access(owner, true)
     * @access(referrer, true)
     */
    public function status(){
        // consume API
        return $this->getStatus();
    }
    
    
    public function provision(){
        $this->status = 'unsubscribed';
    }
    
    public function unprovision(){
        
    }
    
    public function getStatus(){
        $curl = curl_init();
        
        curl_setopt_array($curl, array(CURLOPT_URL => "https://localhost:44300/aps/b743b360-872c-43ba-a7a5-4266d38360cf",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        if ($err) {
            return 'undefined';
        } else {
            if ($httpcode === 404) {
                return 'not_found';
            }
            else{
                return $response ? 'subscribed' : 'unsubcribed';
            }
        }
    }
}

?>
