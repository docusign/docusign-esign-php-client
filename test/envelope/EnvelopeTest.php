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
require_once '../src/service/DocuSign_EnvelopeService.php';

class EnvelopeTest extends PHPUnit_Framework_TestCase
{
	public $service;

	protected function setUp() {
		global $testConfig;
		$client = new DocuSign_Client($testConfig);
		$this->service = new DocuSign_EnvelopeService($client);
	}


	public function testGetEnvelope() {
		global $testData;
		$response = $this->service->envelope->getEnvelope($testData->envelope_id);

		$this->assertEquals($response->status, "sent");
		$this->assertEquals($response->documentsUri, "/envelopes/" . $testData->envelope_id . "/documents");
		$this->assertEquals($response->recipientsUri, "/envelopes/" . $testData->envelope_id . "/recipients");
		$this->assertEquals($response->envelopeUri, "/envelopes/" . $testData->envelope_id);
		$this->assertEquals($response->emailSubject, "<...Test Email Subject...>");
		$this->assertEquals($response->envelopeId, $testData->envelope_id );
	}

	public function testGetEnvelopeRecipients() {
		global $testData;
		$response = $this->service->envelope->getEnvelopeRecipients($testData->envelope_id);

		$this->assertEquals($response->signers[0]->name, $testData->recipient_name);
		$this->assertEquals($response->signers[0]->email, $testData->recipient_email);
		$this->assertEquals($response->signers[0]->recipientId, $testData->recipient_id);
		$this->assertEquals($response->signers[0]->userId, $testData->user_id);
		
		//*** enter values specific to your envelope testing
		$this->assertEquals($response->signers[0]->routingOrder, "1");
		$this->assertEquals($response->signers[0]->status, "sent");
		$this->assertEquals($response->recipientCount, "1");
		$this->assertEquals($response->currentRoutingOrder, "1");
	}

	public function testGetEnvelopeDocuments() {
		global $testData;
		$response = $this->service->envelope->getEnvelopeDocuments($testData->envelope_id);
		$this->assertNotNull($response);
	}

	public function testGetEnvelopeDocumentsCombined() {
		global $testData;
		$response = $this->service->envelope->getEnvelopeDocumentsCombined($testData->envelope_id);
		$this->assertNotNull($response);
	}

}

?>
