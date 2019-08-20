
<!DOCTYPE html>
<html>
<head>
	<title>Авторизация</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<style type="text/css">
		h2,h1,input{
			color: #0278cc;
		}
		button{
			padding: .5em 1em;
    margin-left: 8px;
    border: 1px solid #eee;
    display: inline-block;
    border-radius: 5px;
    background-color: #ff751a;
    background-image: -moz-linear-gradient(top,rgba(0,0,0,0) 3%,rgba(0,0,0,0) 29%,rgba(0,0,0,0.1) 100%);
    background-image: -webkit-linear-gradient(top,rgba(0,0,0,0) 3%,rgba(0,0,0,0) 29%,rgba(0,0,0,0.1) 100%);
    background-image: -ms-linear-gradient(top,rgba(0,0,0,0) 3%,rgba(0,0,0,0) 29%,rgba(0,0,0,0.1) 100%);
    background-image: linear-gradient(to bottom,rgba(0,0,0,0) 3%,rgba(0,0,0,0) 29%,rgba(0,0,0,0.1) 100%);
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.2), 0 1px 2px rgba(0,0,0,0.05);
    color: white;
    text-shadow: 0 -1px 0 rgba(0,0,0,0.35);
    color: #fff;
    font-size: 20px;
    font-size: 2rem;
    line-height: 1;
    white-space: normal;
}
		}
	</style>
</head>
<body style="background-image: url(images/Sas-bg.png);">
	<div class="container-fluid" >
		<div class="row" style="background-color: white;">
			<div class="col-sm-3" ></div>
			<div class="col-sm-9" ><img src="images/sas-logo-mini.png" style="float: left"></div>
		</div>

		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<center>	
					<form  style="margin-top:10%" id = "Auth" method="POST" name="Auth">
						<div style=" background-color: white;border-color: white;border-style: solid; border-radius: 30px;margin: -20px; margin-top:5%;padding-top: 6%;">
								
							<div class="form-group"> 
								<div class="row">
									<div class="col-sm-5"><h2  style="float: right;">Логин</h2></div>
									<div class="col-sm-7">
										<input type="Text" style = "width:60%;float: left; height:60px;font-size:30px;color: #0278cc"class="form-control" id="username"  name = "username"   required="" > 
									</div>
								</div> 
							</div>

								<br>
							<div class="form-group"> 
									<div class="row">
										<div class="col-sm-5"><h2  style="float: right;">Пароль</h2></div>
										<div class="col-sm-7">
											<input type="password" style = "width:60%; float: left;height:60px;font-size:30px;color: #0278cc"class="form-control" id="password"  name = "password"  maxlength="100" required="">  
										</div>
									</div> 
								</div>

								<br>

							<button type="submit" class="button" style="margin-top:1%; margin-bottom:2%;">Войти</button>
						</div>
					</form>
				</center>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
	</div>


</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script> 
$('form#Auth').submit
(
	function(event)
	{ 
		//Clicking on a "Submit" button, prevent it from submitting a form
		event.preventDefault(); 
		
		var a;
		var formData = $(this).serialize();
		//var username=formData[0].value;
		var settings = 
		{
			//"async": true,
			//"crossDomain": true,
			"url": "http://sasbap.demo.sas.com/SASLogon/v1/tickets/?"+ formData,
			"method": "POST",
			"headers": 
			{
				"content-type": "application/x-www-form-urlencoded",
				"accept": "*/*"
			}
		}

		$.ajax(settings).done
		(
			function (data, textStatus, xhr) 
			{
				console.log('Location '+xhr.getResponseHeader( 'Location' ));
				var a = $("input").val();
				//
				//alert('done');
				Swal.fire
				(
					{
						position: 'top-end',
						type: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					}
				)
				window.location.href="check_auth.php?uid="+a;
			}
		 ).fail
		(
			function (xhr) 
			{
				var a = null;
				//alert('УПС ОШИБКА');
				//window.location.href="index.php?uid=";
				//alert(response);
				
				console.log('onreadystatechange '+xhr.onreadystatechange);
				console.log('readyState '+xhr.readyState);
				console.log('responseText '+xhr.responseText);
				console.log('responseXML '+xhr.responseXML);
				console.log('status '+xhr.status);
				console.log('statusText '+xhr.statusText); 
				if(xhr.responseText == 'error.authentication.credentials.bad')
				{
					Swal.fire
					(
						{
							type: 'error',
							title: 'Oops...',
							text: 'Неправильный логин или пароль!'
						}
					)
				}else{
					Swal.fire
					(
						{
							type: 'error',
							text: 'Ошибка на сервере!'
						}
					)
				}
				

			}
		);
	}
);

</script>



