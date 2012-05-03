<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\Queue
 * @author    azurephp@microsoft.com
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace WindowsAzure\Services\ServiceBus;
use WindowsAzure\Core\Http\IHttpClient;
use WindowsAzure\Core\Http\Url;
use WindowsAzure\Core\WindowsAzureUtilities;
use WindowsAzure\Services\Core\Models\GetServicePropertiesResult;
use WindowsAzure\Services\Core\Models\ServiceProperties;
use WindowsAzure\Services\Core\ServiceRestProxy;
use WindowsAzure\Resources;
use WindowsAzure\Utilities;
use WindowsAzure\Validate;

/**
 * This class constructs HTTP requests and receive HTTP responses for queue 
 * service layer.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Services\Queue
 * @author    azurephp@microsoft.com
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class WrapRestProxy extends ServiceRestProxy 
{
    
    public function __construct($channel, $uri, $dataSerializer)
    {
        parent::__construct($channel, $uri, '', $dataSerializer);
    }
    /**
     * Gets a WRAP access token with specified parameters.
     * 
     * @param string $uri       The URI of the WRAP service.
     * @param string $name      The user name of the WRAP service. 
     * @param string $password  The password of the WRAP service. 
     * @param string $scope     The scope of the WRAP service. 
     * 
     * @return WindowsAzure\Services\ServiceBus\Models\WrapAccessTokenResult
     */
    public function wrapAccessToken($uri, $name, $password, $scope)
    {
	 	
        $method      = Resources::HTTP_POST;
        $headers     = array();
        $queryParams = array();
        $statusCode  = Resources::STATUS_OK;
        
        $this->addOptionalQueryParam($queryParams, Resources::WRAP_NAME, $name);
        $this->addOptionalQueryParam($queryParams, Resources::WRAP_PASSWORD, $password);
        $this->addOptionalQueryParam($queryParams, Resources::WRAP_SCOPE, $scope);
        
        $response = $this->send($method, $headers, $queryParams, $uri, $statusCode);
        $parsed   = $this->dataSerializer->unserialize($response->getBody());

        return WrapAccessTokenResult::create($parsed);
    }

}

?>
