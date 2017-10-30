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
        $service_url = 'https://localhost:44300/aps/b743b360-872c-43ba-a7a5-4266d38360ce';
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            return false;
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            return false;
        }
        return $decoded->response;
    }
}

?>
