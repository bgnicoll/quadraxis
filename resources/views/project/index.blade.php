@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<h1>{{ $project->name }}</h1>
	</div>
	<div>
		<p><a href="{{ $project->repo_url }}">{{ $project->repo_url }}</a></p>
	</div>
</div>
@endsection