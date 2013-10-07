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

global $apiConfig;
$apiConfig = array(

    // The DocuSign Integrator's Key
    'integrator_key' => '',

    // The Docusign Account Email
    'email' => '',

    // The Docusign Account password or API password
    'password' => '',
 
    // The version of DocuSign API (Ex: v1, v2)
    'version' => 'v2',

    // The DocuSign Environment (Ex: demo, test, www)
    'environment' => 'demo',

    // The DocuSign Account Id (Optional)
    // For multiple accounts user:
    //   - if it's empty, the default account will be used
    //   - otherwise, the DocuSign account with this account id will be used
    'account_id' => ''
);
