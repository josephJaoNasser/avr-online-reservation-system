$(document).ready(function()
{
	btn_edit_click();
});

function show_rsv_list()
{	
	$("#div_reservation_list").slideDown(500);
}

function hide_rsv_list()
{	
	$("#div_reservation_list").slideUp(1000);
}

function lbl_no_rsv_fadeIn()
{
	$("#no_reservations").fadeIn(1000);	
}
function btn_edit_click()
{
	$('#btn_edit_rsv_items').click(
		function()
		{
			var isclick = true;
			$.ajax({
				method: 'POST',
				url: '../php/home_data.php',
				data: {editisclick: isclick},
				success: function(status)
				{
					$('#itemlist').html(status);
				}
			})
			show_edit();
		}
	);

}

function show_edit()
{
	$("#edit_item_list").fadeIn(500);
}

function hide_edit()
{
	$("#edit_item_list").fadeOut(500);
}

function show_confirm_delete()
{
	if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0)
	{
		$("#black_bg").fadeIn(500);
		$("#confirm_delete").fadeIn(500);

	}
	else
	{
		$("#div_select_items_msg").fadeIn(500);
		$("#btn_okay").click(
			function()
			{
				$("#div_select_items_msg").fadeOut(500);
			}
		);
	}
	
}

function hide_confirm_delete()
{
	$("#confirm_delete").fadeOut(500);
	$("#black_bg").fadeOut(500);
}

function edit_items()
{
	window.location.replace("edit_reserve_room.php");
}

