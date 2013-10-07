<?php
/*
 * Copyright 2013 DocuSign Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

chdir(__DIR__);

require_once 'testConfig.php';
require_once '../src/DocuSign_Client.php';

class BaseTest extends PHPUnit_Framework_TestCase {

  public function testDocuSignClient() {

    global $testConfig;
    $client = new DocuSign_Client($testConfig);

	// ***
	// Enter the values you want to test against.  For instance, the below code tests
	// against v2 of the API, the demo environment, etc...
	// ***
	
	//TODO:
	$versionVal = 		"v2";
	$environVal = 		"demo";
	$accountVal = 		"123456";	
	$baseUrlVal = 		"https://$environVal.docusign.net/restapi/$versionVal/accounts/$accountVal";			
	
    $this->assertNotNull($client->getCreds());
    $this->assertNotNull($client->getHeaders());
    $this->assertNotNull($client->getCUrl());
    $this->assertEquals($client->getVersion(), $versionVal);
    $this->assertEquals($client->getEnvironment(), $environVal);
    $this->assertEquals($client->getBaseURL(), $baseUrlVal);
    $this->assertEquals($client->getAccountID(), $accountVal);
  }

}
