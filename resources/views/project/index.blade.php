@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<h1>{{ $project->name }}</h1>
	</div>
	<label class="vertical-pad" for="project-url">Project URL</label>
	<div >
		<p><a id="project-url" href="{{ $project->repo_url }}">{{ $project->repo_url }}</a></p>
	</div>
	<label class="vertical-pad" for="webhook-url">Webhook Endpoint</label>
	<div >
		<p><span id="webhook-url">{{ $project->webhook_url}}</span></p>
	</div>
	<label class="vertical-pad" for="base-ami">Base AMI</label>
	<div >
		<p><span id="base-ami">{{ $project->base_ami_id}}</span></p>
	</div>
	<label class="vertical-pad">Initialization Script</label>
	<div >
		<p>{{ $project->init_script}}</p>
	</div>
	<div class="row vertical-pad">
		<h3>Environment Variables</h3>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Key</th>
					<th>Value</th>
					<th>Environment</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($project->env_variables() as $variable)
				<tr>
					<td>{{ $variable->key }}</td>
					<td>{{ $variable->value }}</td>
					<td>{{ $variable->environment }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection