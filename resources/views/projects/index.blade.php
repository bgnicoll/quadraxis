@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<p class="text-right">
			<a href="{{ action('ProjectsController@create') }}">New Project</a>
		</p>
	</div>
	<div class="row">
		<div class="row">
			<h1>Projects</h1>
		</div>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>GitHub Repo URL</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($projects as $project)
				<tr>
				<td><a href="{{ action('ProjectsController@show', $project->name) }}">{{ $project->name }}</a></td>
					<td>{{ $project->repo_url }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
