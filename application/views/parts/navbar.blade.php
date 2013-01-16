{{-- Top navigation bar --}}
<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<div class="container-fluid">

			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<a class="brand" href="{{ URL::base_root() }}">&Omega; Your Site Name</a>

			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
				</ul>

				{{-- Render user indicator part--}}
				@render('parts.user')
			</div>

		</div> <!-- .container-fluid -->
	</div> <!-- .navbar-inner -->
</div> <!-- .navbar -->