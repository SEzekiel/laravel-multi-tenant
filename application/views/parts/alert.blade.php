@foreach(array('success', 'error', 'warning') as $type)
	@if(Session::get($type))
		{{ Alert::$type(Session::get($type)) }}
	@endif
@endforeach