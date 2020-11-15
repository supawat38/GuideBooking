<script>
$('document').ready(function(){
	WindowHeight = $( window ).height()-130;
	$('.calendar').fullCalendar({
		height							: WindowHeight,
		eventStartEditable	: false,
			dayClick						: function (date,jsEvent,view) { },
			header							: {
					left					: 'prev,next today',
					center					: 'title',
					right					: 'month'
			},
			defaultDate		: '<?= date('Y-m-d')?>',
			navLinks		: false, 
			editable		: true,
			eventLimit		: true,
			events			: { },
			eventClick		: function(event,date, jsEvent, view){ }
	}); 
});

</script>

<div class="row" >
	<div class="col-sm-12">
		<div class="calendar"></div>
	</div>
</div>
