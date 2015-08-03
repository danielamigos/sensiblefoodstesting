
jQuery(document).ready(function($) {

	$(".dropdown-menu li:last-child").addClass("last-menu-item");
		
	$(".wpcf7-submit").attr("onClick","return wpcf7SubmitConfirm(event);");
	
	
});
var wpcfConfirmShowing = false;
function wpcf7SubmitConfirm(e)
{
	returnValue = false;
	
	if (wpcfConfirmShowing == false)
	{
		bootbox.confirm("Are you sure you are ready to submit<br>This form to Sensible foods? Please be sure<br>the provided Information is accurate.", function(result){ wpcf7SubmitConfirmResult(result); });  
		wpcfConfirmShowing = true;	
	}
	else
	{
		wpcfConfirmShowing = false;	
		returnValue = true;
	}
	return returnValue;
}

function wpcf7SubmitConfirmResult(result)
{
	if (result)
		jQuery(".wpcf7-submit").click();
	wpcfConfirmShowing = false;	
	
}