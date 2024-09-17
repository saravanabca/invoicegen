
$(document).ready(function () {

    gettemp();
    
    function gettemp(){
        $.ajax({
            url: baseUrl + "/active_invoice",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    
                    var templateElement = $(`[tempname="${response.active_template}"]`);
        
                    // Apply the border to the found element
                    // templateElement.css("border", "4px solid #34a853");
                    templateElement.parent().find(".template_active_img").css("display", "block");

                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching invoice details:", error);
            },
        });
    }
    
$(document).on("click", ".template_img", function () {
    var temp_name = $(this).attr("tempname");
    
    // $(".template_img").css("border", "none");
    $(".template_img").parent().find(".template_active_img").css("display", "none");
    $(this).find(".template_active_img").css("display", "block");

    // $(this).css("border", "4px solid #34a853");

    $(this).find('.corner-image').remove();

    // Create a new image element
    var cornerImage = $('<img />', {
        src: baseUrl + "/user/images/invoice/temp_active.png",
        class: 'corner-image',
        alt: 'Active Template'
    });

    // Append the image to the clicked element
    $(this).append(cornerImage);

    $.ajax({
        url: baseUrl + "/template_active",
        type: "POST",
        data: {temp_name: temp_name},
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if(response.status){
                showToast(response.message);

                var activetempname = response.active_template;

                // Remove border from all template_img elements
                // $(".template_img").css("border", "none");
                // $(".template_active_img").css("display", "none");

        
                // Find the element with the matching tempname attribute
                var templateElement = $(`[tempname="${activetempname}"]`);
        
                // Apply the border to the found element
                templateElement.parent().find(".template_active_img").css("display", "block");

              console.log(activetempname);
            //   showToast("update success")
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching invoice details:", error);
        },
    });
});

});

