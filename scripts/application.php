<?php

define('APS_DEVELOPMENT_MODE', true);
require "aps/2/runtime.php";	

/**
* Class app presents application and its global parameters
* @type("http://company.example/app/Office365Adoption/application/1.0")
* @implements("http://aps-standard.org/types/core/application/1.0", "http://odin.com/init-wizard/config/1.0")
*/

class application extends \APS\ResourceBase
{
    # Link to collection of management contexts. Pay attention to [] brackets at the end.
    /**
     * @link("http://company.example/app/Office365Adoption/management/1.0[]")
     */
    public $managements;
    
    /**
     * @verb(GET)
     * @path("/getInitWizardConfig")
     * @access(admin, true)
     * @access(owner, true)
     * @access(referrer, true)
     */
    public function getInitWizardConfig()
    {
        $myfile = fopen("./wizard_data.json", "r") or die("Unable to open file!");
        $data = fread($myfile,filesize("./wizard_data.json"));
        fclose($myfile);
        return json_decode($data);
    }
    
    /**
     * @verb(GET)
     * @path("/testConnection")
     * @param(object,body)
     * @access(admin, true)
     * @access(owner, true)
     * @access(referrer, true)
     */
    public function testConnection($body)
    {
        return "";
    }

	public function configure($new=null){

	}

	public function provision(){

	}

	public function retrieve(){

	}

	public function upgrade(){

	}

	public function unprovision(){

	}

}

?>
