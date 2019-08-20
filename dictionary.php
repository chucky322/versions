<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Справочники</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css" rel="stylesheet">
		<script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.14.2/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
		<link rel="stylesheet" href="css.css">
	</head>
	<body>

		<div class="container-fluid">
			<div class="row">
	<!----------------------------1 колонка------------------------------------->
				<div class="col-sm-1"></div>
	<!----------------------------2 колонка------------------------------------->
				<div class="col-sm-10">
					
					<!-----------------Просто название-------------------------->
					<div class="qwe" style ="margin-top:10%">
							<a href="version.php" class="btn btn-default" role="button">Сборки</a>
							<a href="dictionary.php" class="btn btn-success" role="button">Справочники</a>     
						<h1><b>Справочники</b></h1>
						
					</div>
					<div class="row">
						<div class="col-sm-10">
							<div class="row">
								<?php include 'create_table_version_release_dict.php'; ?>			  
							</div>
						</div>
						<div class="col-sm-2">
							<br>
							<div><button type="button" class="btn btn-default" id="copyy">Просмотреть</button></div>
						</div>
					</div>
				</div>
				<div class="col-sm-1">
					<?php
						echo "
						<div >
							<p style='float:left;font-size:19px;'>".$_SESSION['username']."</p>
							<a href='logout.php'><button type='button' class='btn btn-danger' style='float:right;'>Выйти</button></a>
						</div>	
							"
					?>
				</div>
			</div>
		</div>


		<div class="modal fade" id="new_modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-toggle="modal" data-target="#new_modal"></button>
						<h4 class="modal-title">Просмотр версии справочника</h4>
					</div>
					<div class="modal-body" >	
						<div id = "asd">
							
						</div> 
					
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default"  style="float:left;" data-toggle="modal"data-target="#new_modalClose">закрыть</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#open_new_modal_for_creating">Создать новый</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="new_modalClose" role="dialog"
			aria-hidden="true"
			data-backdrop="static"  
			data-keyboard="false">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-toggle="modal" 
						data-target="#new_modal" 
						></button>
						<center><h4 class="modal-title">Вы уверены, что хотите выйти? </h4></center>
					</div>
					<div class="modal-body">
						<center>
							<button type="button" id="closing" class="btn btn-default" 
								data-toggle="modal" 
								data-target="#new_modal"
								data-dismiss="modal">Да</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
						</center>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="open_new_modal_for_creating" role="dialog"
			aria-hidden="true"
			data-backdrop="static"  
			data-keyboard="false">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-toggle="modal" 
						data-target="#new_modal" 
						></button>
						<center><h4 class="modal-title">Создание нового справочника </h4></center>
					</div>
					<div class="modal-body">
					
						<div class="form-group">
							<label for="usr">PARAMETER_NAME 1:</label>
							<input type="text" class="form-control" id="PARAMETER_NAME1">
						</div>
						<div class="form-group">
							<label for="usr">PARAMETER_NAME 2:</label>
							<input type="text" class="form-control" id="PARAMETER_NAME2">
						</div>
						<div class="form-group">
							<label for="usr">PARAMETER_NAME 3:</label>
							<input type="text" class="form-control" id="PARAMETER_NAME3">
						</div>
						<div class="form-group">
							<label for="usr">CHAR_VALUE 1:</label>
							<input type="text" class="form-control" id="CHAR_VALUE1">
						</div>
						<div class="form-group">
							<label for="usr">CHAR_VALUE 2:</label>
							<input type="text" class="form-control" id="CHAR_VALUE2">
						</div>
						<div class="form-group">
							<label for="usr">CHAR_VALUE 3:</label>
							<input type="text" class="form-control" id="CHAR_VALUE3">
						</div>
						<div class="form-group">
							<label for="usr">NUM_VALUE 1:</label>
							<input type="text" class="form-control" id="NUM_VALUE1">
						</div>
						<div class="form-group">
							<label for="usr">NUM_VALUE 2:</label>
							<input type="text" class="form-control" id="NUM_VALUE2">
						</div>
						<div class="form-group">
							<label for="usr">NUM_VALUE 3:</label>
							<input type="text" class="form-control" id="NUM_VALUE3">
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default"  style="float:left;" data-toggle="modal"data-target="#new_DictClose">закрыть</button>
							<button type="button" class="btn btn-default" id="button_create_new_version">Создать новый</button>
						</div>


					
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="new_DictClose" role="dialog"
			aria-hidden="true"
			data-backdrop="static"  
			data-keyboard="false">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" 
						data-toggle="modal" 
						data-target="#open_new_modal_for_creating" 
						></button>
						<center><h4 class="modal-title">Вы уверены, что хотите выйти? </h4></center>
					</div>
					<div class="modal-body">
						<center>
							<button type="button" id="closing" class="btn btn-default" 
								data-toggle="modal" 
								data-target="#open_new_modal_for_creating"
								data-dismiss="modal">Да</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
						</center>
					</div>
				</div>
			</div>
		</div>		
		
						
	</body>
	<script>
		var $table = $('#myTable');
		var $copy = $('#copyy');
		var $new = $('#button_create_new_version');
		var $cls = $('#closing');

		
		$copy.click
		(function() 
		{
			
			var arr = $table.bootstrapTable('getSelections');
			//var a = Object.values(get_Selections[3]); 
			arr.forEach(function(activate) 
			{	
				$.ajax
				(
					{
						url: "get_special_dict.php",
						method: "POST",
						dataType: "text",
						data:
						{
							"DICT_VER_ID": activate.DICT_VER_ID
						},
						success:function(result) 
						{
							var asd = JSON.parse(result);
							var qwe = asd.get_special_dictResult.Streams._WEBOUT.Value.TABLE.OUTPUT;
							
							$.each(qwe, function() 
							{
								var content  = $('<table id="qweasd"class="table table-bordered table-hover"data-filter-control="true"data-toggle="table"data-sortable="true"data-single-select="true"data-click-to-select="true"data-filter-show-clear="true"data-show-columns="true">');
								for(var i = 0; i < qwe.length; i++)
								{
									var key = Object.keys(this)[i];
									var value = this[key];
									//qwe.each(function(index) {console.log(index)})
									content += '<tr>';
									for(var j = 0; j < 4; j++)
									{
										content +='<td>';
										for(var k = 0; k < 1; k++)
										{
											content += value;
										}										
										content +='</td>';
									}
									content += '</tr>';
								}
								
								content += "</table>"

								$('#asd').append(content);
								
								$('#new_modal').modal('show');

								//удаляю контент по нажатию закрыть 
								$cls.click
								(
									function() 
									{
										console.log("asd");
										$('#asd').html('');
									}
								)

							}); 
							$new.click
							(
								function() 
								{

									var PARAMETER_NAME1 = document.getElementById("PARAMETER_NAME1");
									var PARAMETER_NAME2 = document.getElementById("PARAMETER_NAME2");
									var PARAMETER_NAME3 = document.getElementById("PARAMETER_NAME3");

									var CHAR_VALUE1 = document.getElementById("CHAR_VALUE1");
									var CHAR_VALUE2 = document.getElementById("CHAR_VALUE2");
									var CHAR_VALUE3 = document.getElementById("CHAR_VALUE3");

									var NUM_VALUE1 = document.getElementById("NUM_VALUE1");
									var NUM_VALUE2 = document.getElementById("NUM_VALUE2");
									var NUM_VALUE3 = document.getElementById("NUM_VALUE3");

									alert(PARAMETER_NAME1.value);
									$.ajax
									(
										{
											url: "create_new_release_dict.php",
											method: "POST",
											dataType: "text",
											data:
											{
												"DICT_VER_ID": activate.DICT_VER_ID,
												"PARAMETER_NAME1": PARAMETER_NAME1.value,
												"PARAMETER_NAME2": PARAMETER_NAME2.value,
												"PARAMETER_NAME3": PARAMETER_NAME3.value,
												"CHAR_VALUE1": CHAR_VALUE1.value,
												"CHAR_VALUE2": CHAR_VALUE2.value,
												"CHAR_VALUE3": CHAR_VALUE3.value,
												"NUM_VALUE1": NUM_VALUE1.value,
												"NUM_VALUE2": NUM_VALUE2.value,
												"NUM_VALUE3": NUM_VALUE3.value
											},
											success:function(result) 
											{
												alert("ok");
											}
										}
									);
								}
							)
						}
					}
				);
			});
		})	
	</script>
</html>