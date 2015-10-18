<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use Aws\Ec2\Ec2Client;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project;

        $project->name = $request->input('name');
        $project->repo_url = $request->input('repo_url');
        $project->init_script = $request->input('init_script');
        $project->base_ami_id = $request->input('base-ami');

        $project->save();

        return redirect()->action('ProjectsController@show', $project->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $name)
    {
        $project = Project::where('name', $name)
                        ->get()
                        ->first();
        if (is_null($project))
        {
            abort(404);
        }
        $project->webhook_url = $request->url() . "/webhook";
        return view('project.index')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        //
    }

    public function webhook(Request $request, $name)
    {
        $project = Project::where('name', $name)
                        ->get()
                        ->first();
        if (is_null($project)){
            abort(404);
        }

        $ec2Client = Ec2Client::factory(array(
            'region'  => getenv('AWS_REGION'),
            'version' => '2015-10-01'
        ));

        $result = $ec2Client->runInstances(array(
            'ImageId'        => $project->base_ami_id,
            'MinCount'       => 1,
            'MaxCount'       => 1,
            'InstanceType'   => 't2.medium',
            'UserData'       => base64_encode($project->init_script),
            'SecurityGroups' => array('torvus-sec-group')
        ));

        $instanceId = $result->search('Instances[0].InstanceId');

        $ec2Client->waitUntil('InstanceRunning', [
            'InstanceIds' => array($instanceId)
        ]);

        sleep(120);

        $result = $ec2Client->createImage(array(
            'InstanceId' => $instanceId,
            'Name' => $project->name . time()
        ));

        $imageId = $result->search('ImageId');

        while (1) { 
            $result = $ec2Client->describeImages(array(
                'ImageIds' => array($imageId)
            ));
            $imageState = $result->search('Images[0].State');
            if ($imageState == 'available') {
                break;
            }
            sleep(30);
        }

        // $result = $ec2Client->terminateInstances(array(
        //     'InstanceIds' => array($instanceId)
        // ));
    }
}
