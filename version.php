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
		<title>Сборки</title>
		<meta charset="utf-8">

		<link href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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
						<a href="version.php" class="btn btn-success" role="button">Сборки</a>
						<a href="dictionary.php" class="btn btn-default" role="button">Справочники</a>
						<h1><b>Сборки</b></h1>
					</div>
					
					
					<div class="row">
						<div class="col-sm-10">
							<div class="row">
								<?php include 'create_table_version.php'; ?>				  
							</div>
						</div>
						<div class="col-sm-2">
							<br><br><br>
							<div><button type="button" class="btn btn-warning" id="new" >+Новая </button></div>
							<br>
							<div><button type="button" class="btn btn-default" id="copyy">Скопировать</button></div>
							<br>
							<div><button type="button" class="btn btn-default" id="change">Изменить</button></div>
							<br>
							<div><button type="button" class="btn btn-default" id="activee">Активировать</button></div>
							<br>
							<div><button type="button" class="btn btn-default" id="cancel">Отменить</button></div>
							<br>
							<div><button type="button" class="btn btn-danger" id="delete">Удалить</button></div>
						</div>
					</div>
				</div>
				
				<!----------------------------3 колонка------------------------------------->			
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
		<!--------------------------------модальное окно для кнопки "Новая"-->
						<div class="modal fade" id="new_modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-toggle="modal" data-target="#new_modal"></button>
										<h4 class="modal-title">Новая сборка</h4>
									</div>
									<div class="modal-body" >
										<form method="POST" >
											<label for="select_option">Тип 1:</label>
											<select class="form-control" id="select_option" name="select_option">
												
												<!-----php---><?php include 'config_1.php'; ?>
											</select><br>
											<label for="version">Номер версии:</label>
											<input type="text" class="form-control" id="version" data-mask="0.0.0" required></input>
											<br>
											<label for="template_option">Версия шаблона:</label>
											<select class="form-control" id="template_option" name="template_option">
											
												<option disabled selected value>Выберите из списка</option>
											</select>
											<br>
											
										</form>	
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default"  style="float:left;" data-toggle="modal"data-target="#new_modalClose">Отменить</button>
										<!--<button type="button" class="btn btn-default" data-toggle="modal" data-target="button_create_new_version" id="button_create_new_version">Далее</button>-->
										<button type="button" id="open_new_modal" class="btn btn-default" data-toggle="modal" data-target="#new_next_modal">Далее</button>
									</div>
								</div>
							</div>
						</div>


<!--------------------------------модальное окно для кнопки "Новая"-->
						<div class="modal fade" id="new_next_modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-toggle="modal" data-target="#new_modal"></button>
										<h4 class="modal-title">Новая сборка</h4>
									</div>
									<div class="modal-body" >
										
											<div class="row">
										        <div class="dual-list list-left col-md-5">
										            <div class="well text-right">
										                <div class="row">
										                    <div class="col-md-10">
										                        <div class="input-group">
										                            <span class="input-group-addon glyphicon glyphicon-search"></span>
										                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
										                        </div>
										                    </div>
										                    <div class="col-md-2">
										                        <div class="btn-group">
										                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
										                        </div>
										                    </div>
										                </div>
										               <div id="all_dict">
										                	
										                </div>
										            </div>
										        </div>

										        <div class="list-arrows col-md-1 text-center">
										            <button class="btn btn-default btn-sm move-left">
										                <span class="glyphicon glyphicon-chevron-left"></span>
										            </button>

										            <button class="btn btn-default btn-sm move-right">
										                <span class="glyphicon glyphicon-chevron-right"></span>
										            </button>
										        </div>

										        <div class="dual-list list-right col-md-5">
										            <div class="well">
										                <div class="row">
										                    <div class="col-md-2">
										                        <div class="btn-group">
										                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
										                        </div>
										                    </div>
										                    <div class="col-md-10">
										                        <div class="input-group">
										                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
										                            <span class="input-group-addon glyphicon glyphicon-search"></span>
										                        </div>
										                    </div>
										                </div>
										                <div id="special_dict">
										                	
										                </div>
										               
										            </div>
										        </div>

											</div>
										<br>
											<!-----php---><?php include 'get_all_events.php'; ?>
											

											<label for="text_comment">Комментарий</label>
											<input type="text" class="form-control" id="text_comment"></input>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default"  style="float:left;" data-toggle="modal"data-target="#next_new_modalClose">Назад</button>
										<button type="button" class="btn btn-default" data-toggle="modal"  id="test1">Создать</button>
									</div>
								</div>
							</div>
						</div>


		<!--------------------------------модальное окно для кнопки "Скопировать"-->				
						<div class="modal fade" id="copy_modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-toggle="modal" data-target="#copy_modal"></button>
										<h4 class="modal-title">Новая сборка</h4>
									</div>
									<div class="modal-body" >
										
											<label for="copy_select_option">Тип 1:</label>
											<select class="form-control" id="copy_select_option" >
												
											</select><br>
											<label for="version">Номер версии:</label>
											<input type="text" class="form-control" id="copy_version" data-mask="0.0.0" required></input>
											<br>
										
										<label for="copy_template_option">Версия шаблона:</label>
											<select class="form-control" id="copy_template_option" name="copy_template_option">
												
											</select>
											<br>
											
											
											

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default"  style="float:left;" data-toggle="modal" data-target="#copy_modalClose">Отменить</button>
										<button type="button" class="btn btn-default" id="copy_open_new_modal"   style="float:left;" data-toggle="modal" data-target="#copy_next_modal">Далее</button>
									</div>
								</div>
							</div>
						</div>
							<!--------------------------------модальное окно продолжение "Скопировать"-->	
						<div class="modal fade" id="copy_next_modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-toggle="modal" data-target="#new_modal"></button>
										<h4 class="modal-title">Новая сборка</h4>
									</div>
									<div class="modal-body" >
										
											<div class="row">
										        <div class="dual-list list-left col-md-5">
										            <div class="well text-right">
										                <div class="row">
										                    <div class="col-md-10">
										                        <div class="input-group">
										                            <span class="input-group-addon glyphicon glyphicon-search"></span>
										                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
										                        </div>
										                    </div>
										                    <div class="col-md-2">
										                        <div class="btn-group">
										                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
										                        </div>
										                    </div>
										                </div>
										               <div id="copy_all_dict">
										                	
										                </div>
										            </div>
										        </div>

										        <div class="list-arrows col-md-1 text-center">
										            <button class="btn btn-default btn-sm move-left">
										                <span class="glyphicon glyphicon-chevron-left"></span>
										            </button>

										            <button class="btn btn-default btn-sm move-right">
										                <span class="glyphicon glyphicon-chevron-right"></span>
										            </button>
										        </div>

										        <div class="dual-list list-right col-md-5">
										            <div class="well">
										                <div class="row">
										                    <div class="col-md-2">
										                        <div class="btn-group">
										                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
										                        </div>
										                    </div>
										                    <div class="col-md-10">
										                        <div class="input-group">
										                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
										                            <span class="input-group-addon glyphicon glyphicon-search"></span>
										                        </div>
										                    </div>
										                </div>
										                <div id="copy_special_dict">
										                	
										                </div>
										               
										            </div>
										        </div>

											</div>
										<br>
											<!-----php---><?php include 'copy_get_all_events.php'; ?>
											

											<label for="text_comment">Комментарий</label>
											<input type="text" class="form-control" id="copy_text_comment"></input>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default"  style="float:left;" data-toggle="modal"data-target="#copy_new_modalClose">Назад</button>
										<button type="button" class="btn btn-default" id="copy_create_new_version" data-toggle="modal"  >Создать</button>
									</div>
								</div>
							</div>
						</div>
						<!--------------------------------модальное окно "Изменить"-->
						<div class="modal fade" id="change_modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-toggle="modal" data-target="#new_modal"></button>
										<h4 class="modal-title">Изменить сборку сборка</h4>
									</div>
									<div class="modal-body" >
										
											<div class="row">
										        <div class="dual-list list-left col-md-5">
										            <div class="well text-right">
										                <div class="row">
										                    <div class="col-md-10">
										                        <div class="input-group">
										                            <span class="input-group-addon glyphicon glyphicon-search"></span>
										                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
										                        </div>
										                    </div>
										                    <div class="col-md-2">
										                        <div class="btn-group">
										                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
										                        </div>
										                    </div>
										                </div>
										               <div id="change_all_dict">
										                	
										                </div>
										            </div>
										        </div>

										        <div class="list-arrows col-md-1 text-center">
										            <button class="btn btn-default btn-sm move-left">
										                <span class="glyphicon glyphicon-chevron-left"></span>
										            </button>

										            <button class="btn btn-default btn-sm move-right">
										                <span class="glyphicon glyphicon-chevron-right"></span>
										            </button>
										        </div>

										        <div class="dual-list list-right col-md-5">
										            <div class="well">
										                <div class="row">
										                    <div class="col-md-2">
										                        <div class="btn-group">
										                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
										                        </div>
										                    </div>
										                    <div class="col-md-10">
										                        <div class="input-group">
										                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
										                            <span class="input-group-addon glyphicon glyphicon-search"></span>
										                        </div>
										                    </div>
										                </div>
										                <div id="change_special_dict">
										                	
										                </div>
										               
										            </div>
										        </div>

											</div>
										<br>
											<!-----php---><?php include 'change_get_all_events.php'; ?>
											

											<label for="change_text_comment">Комментарий</label>
											<input type="text" class="form-control" id="change_text_comment"></input>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" id="change_version" data-toggle="modal"  >Изменить</button>
									</div>
								</div>
							</div>
						</div>
			<!--------------------------------модальное окно для кнопки "вы уверены что хотите выйти"-->
			
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
											<button type="button" class="btn btn-default"
												data-toggle="modal" 
												data-target="#new_modal"
												data-dismiss="modal">Да</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
										</center>
									</div>
								</div>
							</div>
						</div>
						
						<div class="modal fade" id="next_new_modalClose" role="dialog"
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
											<button type="button" class="btn btn-default"
												data-toggle="modal" 
												data-target="#new_next_modal"
												data-dismiss="modal">Да</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
										</center>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="copy_modalClose" role="dialog"
							aria-hidden="true"
							data-backdrop="static"  
							data-keyboard="false">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" 
										data-toggle="modal" 
										data-target="#copy_modal" 
										></button>
										<center><h4 class="modal-title">Вы уверены, что хотите выйти? </h4></center>
									</div>
									<div class="modal-body">
										<center>
											<button type="button" class="btn btn-default"
												data-toggle="modal" 
												data-target="#copy_modal"
												data-dismiss="modal">Да</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
										</center>
									</div>
								</div>
							</div>
						</div>
						
						

		<script>
			$(function(){
				$('#mytable').bootstrapTable()
			})
		</script>
		
		
		<script>
		//создаем запрос, который генерируется выбранным типом сборки 
			var RELEASE_TYPE = $('#select_option')

			RELEASE_TYPE.change
				(function () 
					{
						$.ajax
						(
							{
								url: "request.php",
								method: "POST",
								dataType: "text",
								data: {"RELEASE_TYPE1_ID": document.getElementById("select_option").value},
								success:function(result) 
								{
									//загружаем данные полученные от request.php
									$("#template_option").html(result);
								}
							}
						);
					}
				);


			var TPML_OPT = $('#open_new_modal')

			TPML_OPT.click
				(function () 
					{
						
						var check_template_option;
						if(document.getElementById("template_option").value=="")
						{
							check_template_option="null"
						}
						else if(document.getElementById("template_option").value=="null_result")
						{
							check_template_option="null"
						}
						else
						{
							check_template_option=document.getElementById("template_option").value;
						}

						$.ajax
						(
							{

								url: "get_special_dict.php",
								method: "POST",
								dataType: "text",
								data: {"SPEC_DICT": check_template_option},
								success:function(result) 
								{
									//загружаем данные полученные от request.php
									$("#special_dict").html(result);
								}
							}
						);

						$.ajax
						(
							{

								url: "get_all_dict_tables.php",
								method: "POST",
								dataType: "text",
								data: {"TMP_OPTION": check_template_option},
								success:function(result) 
								{
									//загружаем данные полученные от request.php
									$("#all_dict").html(result);
								}
							}
						);
					}
				);




			var COPY_TPML_OPT = $('#copy_open_new_modal')

			COPY_TPML_OPT.click
				(function () 
					{
						
						
						if(document.getElementById("copy_template_option").value=="")
						{
							copy_check_template_option="null"
						}
						else if(document.getElementById("copy_template_option").value=="null_result")
						{
							copy_check_template_option="null"
						}
						else
						{
							copy_check_template_option=document.getElementById("copy_template_option").value;
						}

						$.ajax
						(
							{

								url: "copy_get_special_dict.php",
								method: "POST",
								dataType: "text",
								data: {"COPY_SPEC_DICT": copy_check_template_option},
								success:function(result) 
								{
									//загружаем данные полученные от request.php
									$("#copy_special_dict").html(result);
								}
							}
						);

						$.ajax
						(
							{

								url: "copy_get_all_dict_tables.php",
								method: "POST",
								dataType: "text",
								data: {"COPY_TMP_OPTION": copy_check_template_option},
								success:function(result) 
								{
									//загружаем данные полученные от request.php
									$("#copy_all_dict").html(result);
								}
							}
						);
					}
				);

		</script>

		
<!---------------------------включаю и выключаю кнопки при выбора строки------------------------------------------------->
		<script>
			var $table = $('#myTable');
			var $create_new = $('#new');
			var $copy = $('#copyy');
			var $change = $('#change');
			var $activee = $('#activee');
			var $cancel = $('#cancel');
			var $remove = $('#delete');

			//////////////////////////////////////
			$(function() 
			{
				$table.on
				('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () 
					{
						var jsonObj = JSON.stringify($table.bootstrapTable('getSelections'));
						var jsonObj2 = JSON.parse(jsonObj);
						
						for(var i = 0; i < jsonObj2.length; i++)
						{
							if(jsonObj2[i]['NAME_STATUS']=="In development"){
								$change.prop('disabled', !$table.bootstrapTable('getSelections').length);
								$cancel.prop('disabled', !$table.bootstrapTable('getSelections').length);
								$activee.prop('disabled', !$table.bootstrapTable('getSelections').length);
								$copy.prop('disabled', !$table.bootstrapTable('getSelections').length);//++++работает 
								$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
							}
							else if(jsonObj2[i]['NAME_STATUS']=='Active'){
								$cancel.prop('disabled', !$table.bootstrapTable('getSelections').length)
								$copy.prop('disabled', !$table.bootstrapTable('getSelections').length)//++++работает
								$change.prop('disabled', true)
								$activee.prop('disabled', true)
								//$remove.prop('disabled', true)
								$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
							}
							else if(jsonObj2[i]['NAME_STATUS']=='Canceled'){
								//$remove.prop('disabled', !$table.bootstrapTable('getSelections').length) 
								$copy.prop('disabled', !$table.bootstrapTable('getSelections').length)//++++работает
								$change.prop('disabled', true)
								$activee.prop('disabled', !$table.bootstrapTable('getSelections').length);
								$cancel.prop('disabled', true)
								$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
							}
							else 
							{
								$change.prop('disabled', true)
								$activee.prop('disabled', true)
								$cancel.prop('disabled', true)
								//$remove.prop('disabled', true)
								$remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
							}
		
							
						}
						
					}
				)
				
				//при нажатие на кнопку НОВАЯ, открывается модальное окно
				$create_new.click
				(function () 
					{
						$('#new_modal').modal('show');
						console.log('asd');
					}
				)

				////////////////////////////////////// Открываю модальное окно при нажатии на кнопку скопировать
				$copy.click
				(function () 
					{	
						$('#copy_modal').modal('show');
						
						
						var arr = $table.bootstrapTable('getSelections');
						arr.forEach(function(activate) 
						{

							$('#copy_select_option').append("<option value="+activate.RELEASE_TYPE1+" >" + activate.RELEASE_TYPE1 +"</option>");
							
							$('#copy_template_option').append("<option>" + activate.RELEASE_VERSION +"</option>")
							
						}
						
					);
		
					}
				)
				
				$change.click
				(function () 
					{
						$('#change_modal').modal('show');

						var arr = $table.bootstrapTable('getSelections');
						arr.forEach(function(activate) 
							{
								$.ajax
								(
									{

										url: "get_special_dict.php",
										method: "POST",
										dataType: "text",
										data: {"SPEC_DICT": activate.RELEASE_VERSION},
										success:function(result) 
										{
											//загружаем данные полученные от request.php
											$("#change_special_dict").html(result);
										}
									}
								);

								$.ajax
								(
									{

										url: "get_all_dict_tables.php",
										method: "POST",
										dataType: "text",
										data: {"TMP_OPTION": activate.RELEASE_VERSION},
										success:function(result) 
										{
											//загружаем данные полученные от request.php
											$("#change_all_dict").html(result);
										}
									}
								);
							}
						);


						var change_version = $("#change_version");
						change_version.click
						(
							function () 
							{
								var arr = $table.bootstrapTable('getSelections');


								var cat_str_dict_ver_id;
								var list  = document.getElementsByClassName('list-group-item test');
								//alert(list)
								var listArray=[];
								for (var i=0;i<list.length;i++)
								{
									listArray.push(list[i].getAttribute('value'));
								}
								cat_str_dict_ver_id=listArray.join();



								arr.forEach(function(activate) 
								{

									$.ajax
									(
										{
											url: "update_release_version.php",
											method: "POST",
											dataType: "text",
											data: {"CHANGE_RELEASE_VER_ID": activate.RELEASE_VER_ID,
											"CHANGE_EVENT_NAME": document.getElementById("change_events_option").value,
											"CHANGE_DICT_VER_ID":cat_str_dict_ver_id,
											"CHANGE_TEXT_COMMENT":document.getElementById("change_text_comment").value,
											"CHANGE_NAME_STATUS":activate.NAME_STATUS},
											success:function(result) 
											{
												var res = JSON.parse(result);
												
												if(res=="0")
												{
													Swal.fire
													(
														{
															position: 'top-end',
															type: 'success',
															title: 'Сборка изменена',
															showConfirmButton: false,
															timer: 1500
														}
													)
												}
												else 
												Swal.fire
												(
													{
														type: 'error',
														title: 'Oops...',
														text: 'Что-то пошло не так'
													}
												)
											}
										}
									);
								});
							}
						)
					}
				)
				
				////////////////////////////////////// Активирую сборку
				$activee.click
				(function () 
					{
						var arr = $table.bootstrapTable('getSelections');
						var req = "ACTIVATE_RELEASE_VERSION";
						//var a = Object.values(get_Selections[3]); 
						arr.forEach(function(activate) 
						{
							//alert(el.RELEASE_VER_ID)
							$.ajax
							(
								{
									url: "change_code_status.php",
									method: "POST",
									dataType: "text",
									data: {"RELEASE_VER_ID": activate.RELEASE_VER_ID,
									"REQUEST_TYPE": req},
									success:function(result) 
									{
										var res = JSON.parse(result);
										
										if(res=="0")
										{
											Swal.fire
											(
												{
													position: 'top-end',
													type: 'success',
													title: 'Сборка активирована',
													showConfirmButton: false,
													timer: 1500
												}
											)
										}
										else 
										Swal.fire
										(
											{
												type: 'error',
												title: 'Oops...',
												text: 'Что-то пошло не так'
											}
										)
									}
								}
							);
						});
					}
				)
				////////////////////////////////////// Отменяю сборку
				$cancel.click
				(function () 
					{
						var arr = $table.bootstrapTable('getSelections');
						var req = "CANCELED_RELEASE_VERSION";
						//var a = Object.values(get_Selections[3]); 
						arr.forEach(function(activate) 
						{
							//alert(el.RELEASE_VER_ID)
							$.ajax
							(
								{
									url: "change_code_status.php",
									method: "POST",
									dataType: "text",
									data: {"RELEASE_VER_ID": activate.RELEASE_VER_ID,
									"REQUEST_TYPE": req},
									success:function(result) 
									{
										var res = JSON.parse(result);
										
										if(res=="0")
										{
											Swal.fire
											(
												{
													position: 'top-end',
													type: 'success',
													title: 'Сборка отменена',
													showConfirmButton: false,
													timer: 1500
												}
											)
										}
										else 
										Swal.fire
										(
											{
												type: 'error',
												title: 'Oops...',
												text: 'Что-то пошло не так'
											}
										)
									}
								}
							);
						});
					}
				)
				//////////////////////////////////////Удаляю сборку
				$remove.click
				(function () 
					{
						var arr = $table.bootstrapTable('getSelections');
						//var a = Object.values(get_Selections[3]); 
						arr.forEach(function(el) {
							//alert(el.RELEASE_VER_ID)
							$.ajax
							(
								{
									url: "delete_release_version.php",
									method: "POST",
									dataType: "text",
									data: {"RELEASE_VER_ID": el.RELEASE_VER_ID},
									success:function(result) 
									{
										var res = JSON.parse(result);
										
										if(res=="0")
										{
											Swal.fire
											(
												{
													position: 'top-end',
													type: 'success',
													title: 'Сборка удалена',
													showConfirmButton: false,
													timer: 1500
												}
											)
										}
										else 
										Swal.fire
										(
											{
												type: 'error',
												title: 'Oops...',
												text: 'Что-то пошло не так'
											}
										)
									}
								}
							);
						});
					}
				)
			}
			)
			$copy.prop('disabled', true)
			$change.prop('disabled', true)
			$activee.prop('disabled', true)
			$cancel.prop('disabled', true)
			$remove.prop('disabled', true)
		</script>

		<!-------------------------Задаю формат для ввода------------------------------>
		<script>
			$(document).ready(function(){
				$('#version').mask('0.000.0');
			});
		</script>
		<!-------------------------Создаю новую версию сборки------------------------------>
		<script>
 
				var get_tmp_option_value = document.getElementById("template_option").value;

				var test1= $('#test1')
				test1.click(function () 
					{
						//alert(document.getElementById("template_option").value);
						var cat_str_dict_ver_id;
						var list  = document.getElementsByClassName('list-group-item test');
						//alert(list)
						var listArray=[];
						for (var i=0;i<list.length;i++)
						{
							listArray.push(list[i].getAttribute('value'));
						}
						cat_str_dict_ver_id=listArray.join();
							//console.log(cat_str_dict_ver_id);
						$.ajax
						(
							{
								url: "new_release_version.php",
								method: "POST",
								dataType: "text",
								data: 
								{
									"RELEASE_VERSION": document.getElementById("version").value,
									"RELEASE_TYPE1_ID": document.getElementById("select_option").value,
									"TEXT_COMMENT":document.getElementById("text_comment").value,
									"DICT_VER_ID":cat_str_dict_ver_id,
									"EVENT_NAME": document.getElementById("events_option").value
								},
								success:function(result) 
								{
									var res = JSON.parse(result);
									
									if(res=="0")
									{

										Swal.fire
										(
											{
												position: 'top-end',
												type: 'success',
												title: 'Сборка создана',
												showConfirmButton: false,
												timer: 1500
											}
										)
										$('#new_modal').modal('toggle'); 
										return false;
									}
									else 
									{
										Swal.fire
										(
											{
												type: 'error',
												title: 'Oops...',
												text: 'Что-то пошло не так'
											}
										)
									}
								}
							}
						);
					});

				var create_copy_rel_ver = $('#copy_create_new_version')
				create_copy_rel_ver.click(function () 
				{
					//alert(document.getElementById("template_option").value);
					var copy_cat_str_dict_ver_id;
					var list  = document.getElementsByClassName('list-group-item test');
					//alert(list)
					var listArray=[];
					for (var i=0;i<list.length;i++)
					{
						listArray.push(list[i].getAttribute('value'));
					}
					copy_cat_str_dict_ver_id=listArray.join();
						//console.log(copy_cat_str_dict_ver_id);
						alert(copy_cat_str_dict_ver_id)

						alert( "copy_version"+document.getElementById("copy_version").value)
						alert( "copy_select_option"+document.getElementById("copy_select_option").value)
						alert("copy_text_comment"+document.getElementById("copy_text_comment").value)
						alert("copy_events_option"+document.getElementById("copy_events_option").value)
					$.ajax
					(
						{
							url: "copy_new_release_version.php",
							method: "POST",
							dataType: "text",
							data: 
							{
								"COPY_RELEASE_VERSION": document.getElementById("copy_version").value,
								"COPY_RELEASE_TYPE1_ID": document.getElementById("copy_select_option").value,
								"COPY_TEXT_COMMENT":document.getElementById("copy_text_comment").value,
								"COPY_DICT_VER_ID":copy_cat_str_dict_ver_id,
								"COPY_EVENT_NAME": document.getElementById("copy_events_option").value
							},
							success:function(result) 
							{
								var res = JSON.parse(result);
								
								if(res=="0")
								{
									Swal.fire
									(
										{
											position: 'top-end',
											type: 'success',
											title: 'Сборка создана',
											showConfirmButton: false,
											timer: 1500
										}
									)
									$('#new_modal').modal('toggle'); 
									return false;
								}
								else 
								{
									Swal.fire
									(
										{
											type: 'error',
											title: 'Oops...',
											text: 'Что-то пошло не так'
										}
									)
								}
							}
						}
					);
				});
		</script>		
<!--script for transfer list--->
		<script>
	        $(function () {

	            $('body').on('click', '.list-group .list-group-item', function () {
	                $(this).toggleClass('active');
	            });
	            $('.list-arrows button').click(function () {
	                var $button = $(this), actives = '';
	                if ($button.hasClass('move-left')) {
	                    actives = $('.list-right ul li.active');
	                    actives.clone().appendTo('.list-left ul');
	                    actives.remove();
	                } else if ($button.hasClass('move-right')) {
	                    actives = $('.list-left ul li.active');
	                    actives.clone().appendTo('.list-right ul').addClass('test');
	                    actives.remove();
	                }
	            });
	            $('.dual-list .selector').click(function () {
	                var $checkBox = $(this);
	                if (!$checkBox.hasClass('selected')) {
	                    $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
	                    $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
	                } else {
	                    $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
	                    $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
	                }
	            });
	            $('[name="SearchDualList"]').keyup(function (e) {
	                var code = e.keyCode || e.which;
	                if (code == '9') return;
	                if (code == '27') $(this).val(null);
	                var $rows = $(this).closest('.dual-list').find('.list-group li');
	                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	                $rows.show().filter(function () {
	                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	                    return !~text.indexOf(val);
	                }).hide();
	            });

	        });
		</script>
	</body>
</html>