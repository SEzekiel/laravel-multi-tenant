@layout('layouts.root')

{{-- User Home --}}

@section('content')
	<div class="page-header">
		<h1>{{ $viewed->full_name() }} Home</h1>
	</div>

	<dl>
		<dt>Tenant URL</dt>
		<dd>{{ HTML::link(URL::base($viewed->username)) }}</dd>

		<dt>First Name</dt>
		<dd>{{ $viewed->first_name }}</dd>

		<dt>Last Name</dt>
		<dd>{{ $viewed->last_name }}</dd>

		<dt>E-mail</dt>
		<dd>{{ $viewed->email }}</dd>
	</dl>
@endsection