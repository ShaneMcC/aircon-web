<!DOCTYPE html>
<html>
	<head>
		<title>Aircon Remote</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<style>
<!--			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			} -->

			.remote { text-align: center; }

			.remote .btn {
				width: 100%;
			}

			.remote .btn {
				padding: 0px;
				font-size: 65px;
			}

			#log {
				overflow: hidden;
			}

			.log {
				font-size: 20px;
				line-height: 25px;
				padding: 20px;

				border: 3px solid #BCE8F1;
				background-color: #D9EDF7;
				color: #3A87AD;

				display: none;

				margin-bottom: 5px;
			}

			.log-error {
				border: 3px solid #EED3D7;
				background-color: #F2DEDE;
				color: #BB4F4D;
			}

			.log-success {
				border: 3px solid #D6E9C6;
				background-color: #DFF0D8;
				color: #A4C6A3;
			}

			.log-unknown {
				border: 3px solid #FBEED5;
				background-color: #FCF8E3;
				color: #C09853;
			}

		</style>
		<meta name="viewport" content="user-scalable=no">
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="164x297" href="icon.png">
	</head>
	<body>
		<div class="container">
			<div class="remote">
				<div class="row">
					<div class="span12">
						<button class="btn btn-large btn-inverse btn-wide" type="button" data-action="power">Power</button>
					</div>
				</div>

				<div class="row"><div class="span12">&nbsp;</div></div>

				<div class="row">
					<div class="span6">
						<button class="btn btn-large" type="button" data-action="mode">Function</button>
					</div>
					<div class="span6">
						<button class="btn btn-large btn-danger" type="button" data-action="tempUp">Temp Up</button>
					</div>
				</div>

				<div class="row"><div class="span12">&nbsp;</div></div>

				<div class="row">
					<div class="span6">
						<button class="btn btn-large btn-warning" type="button-" data-action="timer">Timer</button>
					</div>
					<div class="span6">
						<button class="btn btn-large btn-success" type="button" data-action="tempDown">Temp Down</button>
					</div>
				</div>

				<div class="row"><div class="span12">&nbsp;</div></div>

				<div class="row">
					<div class="span6">
						<div id="log"></div>
					</div>
					<div class="span3">
						<button class="btn btn-large btn-info" type="button" data-action="speed">Fan Speed</button>
					</div>
					<div class="span3">
                                                <button class="btn btn-large btn-info" type="button" data-action="setTemp">Set Temp</button>
                                        </div>
				</div>

			</div>
		</div>

		<script>
			function fixButtons() {
				height = (window.innerHeight - 60 - 100) / 4;
				$('.btn').css('height', height + 'px');
				$('#log').css('height', height + 'px');

				/* width = (window.innerWidth - 25) / 2;
				$('.btn').css('width', width + 'px');
				$('.btn-wide').css('width', (width * 2 + 25)+ 'px'); */
			}

			$(function() {
				window.onresize = function(event) {
					fixButtons();
				}

				fixButtons();

				function addLog(text, type) {
					var thisDiv = $(document.createElement('div'));
					thisDiv.addClass('log');
					if (type != undefined) {
						thisDiv.addClass('log-' + type);
					}
					thisDiv.text(text);
					$('#log').prepend(thisDiv);
					thisDiv.fadeIn("slow");

					setTimeout(function(){
						thisDiv.fadeOut("slow", function () {
							thisDiv.remove();
						});
					}, 2000);
				}

				$('.btn').click(function() {
					var action = $(this).data('action');
					addLog('Button Clicked: ' + action);
					var value = false;
					if (action == 'setTemp') {
						var value = prompt("What temperature?", '');
					}

					$.ajax({
						type: 'GET',
						url: 'act.php',
						data: { action: action, value: value }
					}).done(function(msg) {
						var msg = $.parseJSON(msg);
						if (msg.error != undefined) {
							addLog(msg.error, 'error');
						} else if (msg.success != undefined) {
							addLog(msg.success, 'success');
						} else {
							addLog('Unknown result.', 'unknown');
						}
					});

				});
			});
		</script>

	</body>
</html>
