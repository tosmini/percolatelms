<?php

// Percolate LMS
//
// Copyright (C) 2018 Michaels & Associates Docntrain, Ltd.
//
// This program is free software: you can redistribute it and/or modify it under
// the terms of the GNU General Public License as published by the Free Software
// Foundation, either version 3 of the License, or (at your option) any later
// version.
//
// This program is distributed in the hope that it will be useful, but WITHOUT
// ANY WARRANTY; without even the implied warranty of  MERCHANTABILITY or FITNESS
// FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License along with
// this program.  If not, see <http://www.gnu.org/licenses/>.
//

namespace Lms;

class ResTokens extends \HummingJay\Resource{ 
	public $title = "Authentication tokens";
	public $description = "Post your credentials and get a new token in JWT format.";

	public function POST($server){
		$token = null;
		if (isset($server->requestData->access_token)) {
			$access_token = $server->requestData->access_token;
			// is an access token login (change password email link)
			$token = Auth::authenticate_access_token($access_token);
		}else{
			$username = isset($server->requestData->username) ? $server->requestData->username : 'none';
			$password = isset($server->requestData->password) ? $server->requestData->password : 'none';
			$token = Auth::authenticate($username, $password);
		}

		$person_info = Auth::decode_token($token);
		$server->addResponseData([
			"token" => $token,
			"person_info" => $person_info,
		]);

		return $server;
	}
}
