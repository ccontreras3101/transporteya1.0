$(document).ready(function() {
	var letsdraw = false;

	var theCanvas = document.getElementById('canvas');
	var ctx = theCanvas.getContext('2d');
	// theCanvas.width = 420;
	// theCanvas.height = 300;

	var canvasOffset = $('#canvas').offset();

	$('#canvas').mousemove(function(e) {
		if (letsdraw === true) {
			ctx.lineTo(e.pageX - canvasOffset.left, e.pageY - canvasOffset.top);
			ctx.stroke();
		}
	});

	$('#canvas').mousedown(function(e) {
		letsdraw = true;
		ctx.strokeStyle = 'blue';
		ctx.lineWidth = 1;
		ctx.beginPath();
		ctx.moveTo(e.pageX - canvasOffset.left, e.pageY - canvasOffset.top);
	});

	$('#canvas').mouseup(function() {
		letsdraw = false;
	});

	$("#limpiar-canvas").click( function(e){
		e.preventDefault();
		// ctx.restore();
		ctx.clearRect(0, 0, canvas.width, canvas.height);
	});


	$("#guardar-entrega").click(function(e){
		e.preventDefault();

		$("#canvasFirmaUrl").val(theCanvas.toDataURL('image/png'));

		$("form#entrega-form").submit();
	});
});