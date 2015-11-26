jQuery(document).ready(function ($) {

        $(".dropdown-menu li:last-child").addClass("last-menu-item");

        $(".wpcf7-submit").attr("onClick", "return wpcf7SubmitConfirm(event);");

        //var fMap = {11: 2, 12: 3, 13: 4, 14: 5, 15: 6, 16: 7, 17: 8, 24: 18, 19: 22, 20: 23};
        var fMap = {11: 2, 12: 3, 13: 4, 14: 5, 15: 6, 16: 7, 17: 8, 31: 18, 19: 25, 22: 28};

        function doSame() {
            console.log('SAME')
            for (i in fMap)
                $('#wpsc_checkout_form_' + i).val($('#wpsc_checkout_form_' + fMap[i]).val());
        }

        function doSameTrigger() {
            if(document.getElementById('doSame'))
            if (document.getElementById('doSame').checked) {
                $("#shippingSection").hide();
                for (var i in fMap) {
                    if ($('#wpsc_checkout_form_' + fMap[i]).length) {
                        $('#wpsc_checkout_form_' + fMap[i]).on('change', doSame);
                        $('#wpsc_checkout_form_' + fMap[i]).on('keyup', doSame);
                    }
                }
            } else {
                $("#shippingSection").show();
                for (var i in fMap) {
                    if ($('#wpsc_checkout_form_' + fMap[i]).length) {
                        $('#wpsc_checkout_form_' + fMap[i]).off('change', doSame);
                        $('#wpsc_checkout_form_' + fMap[i]).off('keyup', doSame);
                    }
                }
            }
        }

        $('#calculateShipping').on('click', function(){
            $('#calculateShippingForm').submit()
        })

        doSameTrigger();
        $('#doSame').on('change', function () {
            doSameTrigger();
        });

    }
)
;
var wpcfConfirmShowing = false;

function wpcf7SubmitConfirm(e) {
    returnValue = false;

    if (wpcfConfirmShowing == false) {
        bootbox.confirm("Are you sure you are ready to submit<br>This form to Sensible foods? Please be sure<br>the provided Information is accurate.", function (result) {
            wpcf7SubmitConfirmResult(result);
        });
        wpcfConfirmShowing = true;
    }
    else {
        wpcfConfirmShowing = false;
        returnValue = true;
    }
    return returnValue;
}

function wpcf7SubmitConfirmResult(result) {
    if (result)
        jQuery(".wpcf7-submit").click();
    wpcfConfirmShowing = false;

}