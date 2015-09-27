@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<h1>New Project</h1>
	</div>
	<div class="row vertical-pad">
		<form action="{{ action('ProjectsController@store') }}" method="post">
			<div class="form-group">
				<p>
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" id="name" placeholder="Quadraxis">
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="repo_url">GitHub Repo URL</label>
					<input type="text" class="form-control" name="repo_url" id="repo_url" placeholder="https://github.com/you/coolProject">
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="init_script">Intialization Script</label>
					<textarea class="form-control" id="init_script" name="init_script" rows="10" placeholder="apt-get update"></textarea>
				</p>
			</div>
			<button type="submit" class="btn btn-default">Create Project</button>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
@endsection
