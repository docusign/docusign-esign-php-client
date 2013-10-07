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

require_once 'DocuSign_Service.php';
require_once 'DocuSign_Resource.php';

class DocuSign_EnvelopeService extends DocuSign_Service {

	public $envelope;

	/**
	* Constructs the internal representation of the DocuSign Envelope service.
	*
	* @param DocuSign_Client $client
	*/
	public function __construct(DocuSign_Client $client) {
		parent::__construct($client);
		$this->envelope = new DocuSign_EnvelopeResource($this);
	}
}

class DocuSign_EnvelopeResource extends DocuSign_Resource {

	public function __construct(DocuSign_Service $service) {
		parent::__construct($service);
	}
	
	public function getEnvelope($envelopeId) {
		if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
		{
			return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
		}
		$url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId;
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getEnvelopeRecipients($envelopeId) {
		if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
		{
			return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
		}
		$url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/recipients';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getEnvelopeDocuments($envelopeId, $documentId = NULL) {
		if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
		{
			return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
		}
		$url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/documents/';
		if(isset($documentId)) $url .= $documentId;
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getEnvelopeDocumentsCombined($envelopeId, $certificate = true) {
		if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
		{
			return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
		}
		$url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/documents/combined';
		$params = (is_bool($certificate) === true) ? array( 'certificate' => 'true') : array();
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders('Accept: application/pdf', 'Content-Type: application/pdf'), $params);
	}

}

?>