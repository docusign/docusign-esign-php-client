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

require_once 'testConfig.php';
require_once '../src/DocuSign_Client.php';
require_once '../src/service/DocuSign_StatusService.php';

class StatusTest extends PHPUnit_Framework_TestCase
{
	public $service;

	protected function setUp() {
		global $testConfig;
		$client = new DocuSign_Client($testConfig);
		$this->service = new DocuSign_StatusService($client);
	}


	public function testGetStatus() {
		$fromDate = mktime(0,0,0,8,5,2013);
		$fromToStatus = "sent";
		$response = $this->service->status->getStatus($fromDate, $fromToStatus);
		
		$this->assertNotNull($response->resultSetSize);
		$this->assertNotNull($response->totalSetSize);
		$this->assertNotNull($response->envelopes);
	}

}

?>
