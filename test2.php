<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.dual-list .list-group {
            margin-top: 8px;
        }

        .list-left li, .list-right li {
            cursor: pointer;
        }

        .list-arrows {
            padding-top: 100px;
        }

            .list-arrows button {
                margin-bottom: 20px;
            }
</style>
<div class="container">
    <br />
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
                <ul class="list-group">
                    <li class="list-group-item">bootstrap-duallist <a href="https://github.com/bbilginn/bootstrap-duallist" target="_blank">github</a></li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
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
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>

	</div>
</div>
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
                    actives.clone().appendTo('.list-right ul');
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