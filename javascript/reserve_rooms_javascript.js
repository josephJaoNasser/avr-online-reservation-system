var sched = "";

$(document).ready(function()
{
	show_popup_window();
	select_sched_click();
	select_date_click();
	confirm_rsv();
	btn_back_click();				
});

function confirm_rsv()
{
	$('#mk_rsv').click(
		function()
		{
				var confirmreserved = true;
				$.ajax({
					method: 'POST',
					url: '../php/reserve_rooms_data.php',
					data: {isreserved: confirmreserved},
					success: function(status)
					{
						$('#rsv_summary').html(status);
						window.location.replace("home.php");
					}
			});			
		}
	);

}

function select_date_click()
{
	$('button').click(
		function()
		{
			if (this.id == 'selected_date')
			{
				var date = this.value;
				$.ajax({
					method: 'POST',
					url: '../php/reserve_rooms_data.php',
					data: {date: date, time: sched},
					success: function(status)
					{					
						$('#rsv_summary').html(status);
					}
				});
				show_confirm();
			}			
		}
	);
}

function show_confirm()
{
	$('#confirm_rsv').fadeIn(500);
	$('#black_window_bg').fadeIn(500);
}

function hide_confirm()
{
	$('#confirm_rsv').fadeOut(500);
	$('#black_window_bg').fadeOut(500);
}

function select_sched_click()
{
	$("#btn_select_sched").click(
		function()
		{
			$("#time_window_bg").fadeOut(500);
			hide_popup_window();
			calendar_header_slide_down();
			calendar_slide_down();
			sched = document.getElementById('select_time').value;	
			$.ajax({
					method: 'POST',
					url: '../php/reserve_rooms_data.php',
					data: {time: sched},
					success: function(status)
					{					
						$('#cal_style').html(status);
					}
				});	
		}
	);
}
					
function btn_back_click()
{
	$("#btn_back_red").click(
		function()
		{
			window.location = "home.php";
		}
	);
}


function calendar_header_slide_down()
{
	$("#calendar_header").slideDown(800);
}

function calendar_slide_down()
{
	$("#calendar").slideDown(800);
}

function show_popup_window()
{
	$("#black_window_bg").fadeIn(500);
	show_window();
}

function show_window()
{
	$("#window").fadeIn(500);	
}

function hide_popup_window()
{
	$("#black_window_bg").fadeOut(500);
	hide_window();
}

function hide_window()
{
	$("#window").fadeOut(500);	
}