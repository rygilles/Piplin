<?php

/*
 * This file is part of Piplin.
 *
 * Copyright (C) 2016-2017 piplin.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Piplin\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Piplin\Http\Controllers\Controller;
use Piplin\Models\Project;

/**
 * The deployment webhook management controller.
 */
class WebhookController extends Controller
{
    /**
     * Generates a new webhook URL.
     *
     * @param Project $project
     * @param string  $type
     *
     * @return Response
     */
    public function refresh(Project $project, $type = '')
    {
        $project->generateHash();
        $project->save();

        return [
            'url' => route($type == 'build' ? 'webhook.build' : 'webhook.deploy', $project->hash),
        ];
    }
	
	/**
	 * Update project webhook branch env link setting value
	 *
	 * @param Request $request
	 * @param Project $project
	 * @param string  $type
	 *
	 * @return Response
	 */
    public function branchEnvLink(Request $request, Project $project, $type = '')
    {
	    $validator = Validator::make($request->all(), [
		    'value' => 'required|in:1,0'
	    ]);
	
	    if ($validator->fails()) {
	    	return response()->json($validator->errors(), 400);
	    }
    	
    	$field = ($type == 'build' ? 'build' : 'deploy') . '_webhook_branch_env_link';
	    $project->$field = (int)$request->get('value');
	    $project->save();
	    
	    return response()->json([
	        'value' => $project->$field
	    ]);
    }
}
