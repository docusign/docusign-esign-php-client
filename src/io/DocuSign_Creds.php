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

class DocuSign_Creds {
	
	// The DocuSign Integrator's Key
	private $integratorKey;

	// The Docusign Account Email
	private $email;

	// The Docusign Account password or API password
	private $password;

	public function __construct($integratorKey, $email, $password) {
		if( isset($integratorKey) ) $this->integratorKey = $integratorKey;
		if( isset($email) ) $this->email = $email;
		if( isset($password) ) $this->password = $password;
	}

  	public function setIntegratorKey($integratorKey) { $this->integratorKey = $integratorKey; }
	public function getIntegratorKey() { return $this->integratorKey; }
	public function setEmail($email) { $this->email = $email; }
	public function getEmail() { return $this->email; }
	public function setPassword($password) { $this->password = $password; }
	public function getPassword() { return $this->password; }
	public function isEmpty() {
		if(empty($this->integratorKey) || empty($this->email) || empty($this->password)) {
			return true;
		}
		return false;
	}
}

?>