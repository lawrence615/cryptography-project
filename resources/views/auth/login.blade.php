@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col s7 offset-s3">
			<div class="panel panel-default">
				<h4>Login</h4>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="col s12" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="input-field">
                                  <i class="material-icons prefix">account_circle</i>
                                  <input id="icon_prefix" class="validate" name="email" type="email" class="validate" value="{{ old('email') }}">
                                  <label for="icon_prefix">E-Mail Address</label>
                         </div>


                         <div class="input-field">
                                   <i class="material-icons prefix">lock</i>
                                   <input id="password" name="password" type="password" class="validate">
                                   <label for="password">Password</label>
                          </div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
									Login
								</button>

								<a href="/password/email">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
