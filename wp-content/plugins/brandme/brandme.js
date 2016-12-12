/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

jQuery(".next").click(function () {
    if (animating)
        return false;
    animating = true;

    current_fs = jQuery(this).parent();
    next_fs = jQuery(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50) + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'transform': 'scale(' + scale + ')'});
            next_fs.css({'left': left, 'opacity': opacity});
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

jQuery(".previous").click(function () {
    if (animating)
        return false;
    animating = true;

    current_fs = jQuery(this).parent();
    previous_fs = jQuery(this).parent().prev();

    //de-activate current step on progressbar
    jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1 - now) * 50) + "%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});


var XMLArray;
jQuery(function () {
    var input = jQuery("#brandme_user_address").val();
    var url = "https://maps.googleapis.com/maps/api/place/autocomplete/xml";
    jQuery("#brandme_user_address").autocomplete({
        source: function (request, response) {
            jQuery.ajax({
                url: url,
                type: "GET",
                data: "input=" + input + "&key=AIzaSyA-LqxT-FJD_d67EdRt8izVF8S2HEbA6os",
                datatype: "xml",
                success: parseXml,
                error: function () {
                    alert("XML File Could not be Accessed");
                }
            });
        }
        //select: function (event, ui){
        //  this.value = ui.item.label;
        //  jQuery(this).next("")
        //}
    });
});

function parseXml(xml) {
    var prediction = jQuery(xml).find("prediction");
    jQuery(prediction).each(function () {
        XMLArray.push(jQuery(this).attr("term"));
    });
}