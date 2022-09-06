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
 * @package   WindowsAzure\Blob\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
 
namespace WindowsAzure\Blob\Models;

/**
 * Holds info about mix range used in HTTP requests
 *
 * @category  Microsoft
 * @package   WindowsAzure\Blob\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: 0.4.0_2014-01
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class PageRange
{
    /**
     * @var integer
     */
    private $_start;
    
    /**
     * @var integer
     */
    private $_end;

    /**
     * Constructor
     * 
     * @param integer $start the pages start value
     * @param integer $end   the pages end value
     * 
     * @return PageRange
     */
    public function __construct($start = null, $end = null)
    {
        $this->_start = $start;
        $this->_end   = $end;
    }
    
    /**
     * Sets pages start range
     * 
     * @param integer $start the pages range start
     * 
     * @return none.
     */
    public function setStart($start)
    {
        $this->_start = $start;
    }
    
    /**
     * Gets mix start range
     * 
     * @return integer
     */
    public function getStart()
    {
        return $this->_start;
    }
    
    /**
     * Sets pages end range
     * 
     * @param integer $end the pages range end
     * 
     * @return none.
     */
    public function setEnd($end)
    {
        $this->_end = $end;
    }
    
    /**
     * Gets mix end range
     * 
     * @return integer
     */
    public function getEnd()
    {
        return $this->_end;
    }
    
    /**
     * Gets mix range length
     * 
     * @return integer
     */
    public function getLength()
    {
        return $this->_end - $this->_start + 1;
    }
    
    /**
     * Sets pages range length
     * 
     * @param integer $value new pages range
     * 
     * @return none
     */
    public function setLength($value)
    {
        $this->_end = $this->_start + $value - 1;
    }
}


