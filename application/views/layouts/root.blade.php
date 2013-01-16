<!doctype html>
<html>
<head>
	<title>Your Site Title Here</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{ Asset::container('bootstrap')->styles() }}
	{{ Asset::container('bootstrap')->scripts() }}
</head>
<body>
	@render('parts.navbar')
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				@yield('content')
			</div>
		</div>
	</div>
</body>
</html>