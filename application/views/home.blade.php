@layout('layouts.root')

@section('content')
	<div class="page-header">
		<h1>Root Home</h1>
	</div>

	<dl>
		<dt>Root URL</dt>
		<dd>{{ HTML::link(URL::base_root()) }}</dd>

		<dt>Users</dt>
		<dd>
			<ul>
				@foreach(User::all() as $user)
				<li>{{ HTML::link(URL::to_tenant($user->username), $user->full_name()) }}</li>
				@endforeach
			</ul>
		</dd>
	</dl>
@endsection