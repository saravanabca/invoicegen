$(document).ready(function() {    
 
    var coreJSON,user_id ,mode;
    $.when(getGallery()).done(function(){
        dispGallery(coreJSON);     
        // console.log(coreJSON);     
    });
    

    // ***************************[Get] ********************************************************************

    // $(document).ready(function () {
    //     // alert();
    //     $.ajax({
    //         url: base_Url + "/user_list_get",
    //         type: "GET",
    //         dataType: "json",
    //         success: function (response) {
    //             coreJSON = $.parseJSON(data);                

    //         },
    //         error: function (xhr, status, error) {
    //             // console.error(xhr.responseText);
    //         },
    //     });
    // });


    function getGallery()
    {
        return $.ajax({
            url: base_Url + "/invoice_list_get",
            type:'GET',
            success:function(data){
                coreJSON = data.invoicedetails;                
            },      
            error: function() { 
                console.log("Error");  
            }
        });
    }
    
  
// *************************** [Display] ********************************************************************
function dispGallery(data) {
    // var invoicedata = data;
    // console.log(data);
    var i = 0;
    // var base_Url = "http://localhost/invoice/public/";

    $("#datatable").dataTable({
        // aaSorting: [],
        aaData: data,
        aoColumns: [
            {
                "mData": function ( data, type, full, meta) {
                    return ++i;
                }
            },
            {
                mData: function (data, type, full, meta) {
                    return data.auth_mail;
                },
            },
            {
                mData: function (data, type, full, meta) {
                    return data.invoice_number;
                },
            },
          
          
            // {
            //     "mData": function ( data, type, full, meta) {
            //         return  '<a id="'+ meta.row +'" class="btn btnEdit"><i class="mdi mdi-book-edit-outline"></i></a>';
            //         // +'<a id="'+ meta.row +'" class="btn BtnDelete"><i class="mdi mdi-trash-can"></i></a>';
            //     }
            // },
        ],
    });
}
    

});