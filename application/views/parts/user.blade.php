<ul class="nav pull-right">

{{-- Show Login link if viewed by guest--}}
@if(Auth::guest())
	<li>{{ HTML::link('login', 'Login') }}</li>

{{-- otherwise, show user data --}}
@else
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			{{ $user->full_name() }}
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li> {{ HTML::link(URL::base($user->username), 'Visit Site') }} </li>
			<li> {{ HTML::link(URL::to_tenant($user->username,'dashboard/profile'), 'Edit Profile') }} </li>
			<li class="divider"></li>
			<li> {{ HTML::link(URL::to_root('logout'), 'Logout') }} </li>
		</ul>
	</li>
@endif

 </ul>
	