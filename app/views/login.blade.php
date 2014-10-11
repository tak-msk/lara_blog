<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Login | lara_blog</title>
	
	<!-- Bootstrap -->
	{{HTML::style('asset/css/bootstrap.min.css')}}

	<!-- Custom styles for this template -->
	{{HTML::style('asset/css/signin.css')}}

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
	<!-- [if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		{{Form::open(array('class'=>'form-signin'))}}
		<h2 class="form-signin-heading">Please sign in</h2>
		{{Form::text('username','',array('class'=>'form-control','placeholder'=>'Username'))}}
		{{Form::password('password',array('class'=>'form-control','placeholder'=>'Password'))}}
		@if($errors->has('warning'))
		<div class="alert alert-danger">
			{{$errors->first('warning')}}
		</div>
		@endif
		{{Form::checkbox('remember',1,false,['id'=>'label_1'])}}<label for="label_1" class="remember">Remember me</label>
		{{Form::submit('Sign in',array('class'=>'btn btn-lg btn-primary btn-block'))}}
		{{Form::close()}}
	</div><!-- /.container -->
</body>
</html>
