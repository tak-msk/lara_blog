<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		@section('title')
		Lara_blog
		@show
	</title>
	<!-- Bootstrap core CSS -->
	{{ HTML::style('asset/css/bootstrap.min.css') }}
	<!-- Custom style for this template -->
	{{ HTML::style('asset/css/template.css') }}
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{{ URL::to('/') }}}">Lara_blog</a>
			</div><!-- /.navbar-header -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="{{Request::is('backend/dashboard')?'active':''}}"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
					<li class="{{Request::is('backend/articles*')?'active':''}}"><a href="{{ URL::to('backend/articles')}}">Article</a></li>
					<li class="{{Request::is('backend/categories*')?'active':''}}"><a href="{{ URL::to('backend/categories') }}">Category</a></li>
					<li class="{{Request::is('backend/blocks*')?'active':''}}"><a href="#">Block</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{{ URL::route('logout') }}}">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse collapase -->
		</div><!-- /.container -->
	</div><!-- /.navbar .navbar-default .navbar-fixed-top -->
	<div class="container">
		<!-- Content -->
		@yield('content')
	</div><!-- /.container -->

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
{{ HTML::script('asset/js/bootstrap.min.js') }}
@show

</body>
</html>
