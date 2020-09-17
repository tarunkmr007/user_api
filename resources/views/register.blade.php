<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-4" id="hide_form">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">{{ __('Register') }}</div>

		                <div class="card-body">
		                    <form method="POST" id="frm">
		                        
		                    	<div class="form-group row">
		                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

		                            <div class="col-md-6">
		                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

		                            <div class="col-md-6">
		                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

		                            <div class="col-md-6">
		                                <input id="password" type="password" class="form-control" name="password" required>

		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="c_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

		                            <div class="col-md-6">
		                                <input id="c_password" type="c_password" class="form-control" name="c_password" required>

		                            </div>
		                        </div>

		                        <div class="form-group row mb-0">
		                            <div class="col-md-8 offset-md-4">
		                                <button type="submit" class="btn btn-primary">
		                                    {{ __('Register') }}
		                                </button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div> 
		<div class="container mt-4" id="shw_form" style="display: none;">
			<h4 id="data"></h4>
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">{{ __('Update Profile') }}</div>

		                <div class="card-body">
		                    <form method="POST" id="frm_update">
		                        
		                    	<div class="form-group row">
		                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

		                            <div class="col-md-6">
		                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

		                            <div class="col-md-6">
		                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
		                            </div>
		                        </div>
		                        <div class="form-group row">
		                            <label for="mother" class="col-md-4 col-form-label text-md-right">{{ __('Mother') }}</label>

		                            <div class="col-md-6">
		                                <input id="mother" type="mother" class="form-control" name="mother" required  autofocus>
		                            </div>
		                        </div>
		                        <div class="form-group row">
		                            <label for="father" class="col-md-4 col-form-label text-md-right">{{ __('Father') }}</label>

		                            <div class="col-md-6">
		                                <input id="father" type="father" class="form-control" name="father" required  autofocus>
		                            </div>
		                        </div>

		                        <div class="form-group row">
		                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

		                            <div class="col-md-6">
		                                <input id="password" type="password" class="form-control" name="password" required>

		                            </div>
		                        </div>

		                        <div class="form-group row mb-0">
		                            <div class="col-md-8 offset-md-4">
		                                <button type="submit" class="btn btn-primary">
		                                    {{ __('Update') }}
		                                </button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
    </body>
    <script
              src="https://code.jquery.com/jquery-3.5.1.min.js"
              integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous"></script>
    <script>
    	var api_token;
        $('#frm').submit(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url : '/api/register',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function(value){
                    console.log(value);
                    api_token = value.success['token'];
                    $('#data').html(value.success['msg']);

                    $('#hide_form').css('display', 'none');
                    $('#shw_form').css('display','block');
                }
            });
           
        });

        $('#frm_update').submit(function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + api_token
                }
            });
            $.ajax({
                type: 'post',
                url : '/api/update',
                data: $(this).serialize(),
                dataType: 'JSON',
                success: function(value){
                    console.log(value);
                    $('#data').html(value.success);
                    $('#hide_form').css('display', 'none');
                    $('#shw_form').css('display','block');
                }


            });
           
            // alert('hi');
        });
    </script>
</html>
