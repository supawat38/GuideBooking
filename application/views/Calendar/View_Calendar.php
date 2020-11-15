<div id='external-events'>
  <p>
    <strong>Draggable Events</strong>
  </p>
  <div class='fc-event'>My Event 1</div>
  <div class='fc-event'>My Event 2</div>
  <div class='fc-event'>My Event 3</div>
  <div class='fc-event'>My Event 4</div>
  <div class='fc-event'>My Event 5</div>
  <p>
    <input type='checkbox' id='drop-remove' />
    <label for='drop-remove'>remove after drop</label>
  </p>
</div>

<div id='calendar-container'>
  <div id='calendar'></div>
</div>

<!--โหลดไฟล์ footer พวก script-->
<?php include __DIR__ . '/../script.php';?>
<link href='<?=base_url('application/assets/js/lib/main.css')?>' rel='stylesheet' />
<script src='<?=base_url('application/assets/js/lib/main.js')?>'></script>

<script>
	
$(function() {

// initialize the external events
// -----------------------------------------------------------------

$('#external-events .fc-event').each(function() {

	// store data so the calendar knows to render an event upon drop
	$(this).data('event', {
		title: $.trim($(this).text()), // use the element's text as the event title
		stick: true // maintain when user navigates (see docs on the renderEvent method)
	});

	// make the event draggable using jQuery UI
	$(this).draggable({
		zIndex: 999,
		revert: true,      // will cause the event to go back to its
		revertDuration: 0  //  original position after the drag
	});

});

// initialize the calendar
// -----------------------------------------------------------------

$('#calendar').fullCalendar({
	header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
	editable: true,
	droppable: true, // this allows things to be dropped onto the calendar
	drop: function() {
		// is the "remove after drop" checkbox checked?
		if ($('#drop-remove').is(':checked')) {
			// if so, remove the element from the "Draggable Events" list
			$(this).remove();
		}
	}
});

});

</script>

<style>

#external-events {
  position: fixed;
  z-index: 2;
  top: 20px;
  left: 20px;
  width: 150px;
  padding: 0 10px;
  border: 1px solid #ccc;
  background: #eee;
}

#external-events .fc-event {
  margin: 1em 0;
  cursor: move;
}

#calendar-container {
  position: relative;
  z-index: 1;
  margin-left: 200px;
}

#calendar {
  max-width: 900px;
  margin: 20px auto;
}

</style>
