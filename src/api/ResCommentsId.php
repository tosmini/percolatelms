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

class ResCommentsId extends \HummingJay\Resource{ 
	public $title = "This is a specific comment";
	public $description = "DELETE this resource to mark the comment as deleted.";

	public function DELETE($server){
		$person_info = Auth::require_token();

		// won't actually need this because the comment_id is very specific
		// but let's pull it just to remember that we have it
		$content_id = $server->params['content_id'];

		$comment_id = $server->params['comment_id'];
		$db = Db::update('comment', ['deleted'=>'true'], $comment_id);

		return $server;
	}
}

