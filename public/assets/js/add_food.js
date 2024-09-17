$(document).ready(function() {    
    $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          
    var coreJSON,newsimage_id ,mode;
    $.when(getGallery()).done(function(){
        dispGallery(coreJSON);          
    });
    // alert();
    $('.validate_border').hide();

    $('#addNew').click(function(){
        mode="new";
        $("#user_uploaded_image").css("display", "none");
        $('#myModal').modal('show');
    });

// *************************** [Validation] ******************************************************************** 
    $('#formSubmit').click(function(e){
        $('.invalid-feedback').hide();
        // e.preventDefault();


        if($('#category_id').val()=="" && mode == 'new')
        {
            $('.validate_border').show();
            $('.category_id').html('Please choose Food Category Name').show();
        }
        else if($('#food_name').val()=="" && mode == 'new')
        {
            $('.food_name').html('Please Enter Food Name').show();
        }
        else if($('#food_rate').val()=="" && mode == 'new')
        {
            $('.food_rate').html('Please Enter Food Rate').show();
        }
       else if($('#food_number').val()=="" && mode == 'new')
        {
            $('.food_number').html('Please Enter Food Number').show();
        }
        else if($('#image_url').val()=="" && mode == 'new')
        {
            $('.image_url').html('Please choose Food image');
            $('.image_url').show();
        }
       
       
        else
        {
            // return;
            saveGallery();
        }       
    });
    // *************************** [Insert and Update] ********************************************************************

    function saveGallery()
    {       
        
        var form = $('#formModal')[0];
        var data = new FormData(form);
        // var formData = new FormData(this);
        // alert(formData);
        if (mode == "new")
        {
            var url = baseUrl+"/food_add";
        }
        // else if (mode == "update")
        // {
        //     var url = base_URL+"admin/KaanalAdmin/update_newsimage";
        //     data.append("newsimage_id",newsimage_id);
        // }
        // return;
        request = $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: url,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert("success",data);
                    // // return;
                    // var insertResult = $.parseJSON(data);
                   
                    // if(insertResult.status=="success")
                    // {
                    //     $.confirm({
                    //         icon: 'icon-close',
                    //         title: 'congratulations...!',
                    //         content: 'Updated Sucessfully',
                    //         type: 'green',
                    //             buttons: {
                    //                 Ok: function() {
                    //                     location.reload();
                    //                 },
                    //             }
                    //     }); 
                    //     request.done(function (response){
                    //         $('#myModal').modal('hide');         
                    //         refreshDetails();
                    //     });
                    // }
                    // else{
                    //     $.confirm({
                    //       title: 'Encountered an error!',
                    //       content: insertResult['message'],
                    //       type: 'red',
                    //       typeAnimated: true,
                    //       buttons: {
                    //           tryAgain: {
                    //               text: 'Try again',
                    //               btnClass: 'btn-red',
                    //               action: function(){
                    //               }
                    //           },
                    //           close: function () {
                    //           }
                             
                    //       }
                    //   });
                      
                    // }
                },
                error: function(data){
                  alert('fail',data);
                }
                    
        });    
    }

    $('#myModal').on('show.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('.invalid-feedback').hide();
    }); 


    // ***************************[Get] ********************************************************************

    function getGallery()
    {
        return $.ajax({
            url: base_URL+'admin/KaanalAdmin/get_newsimage',
            type:'POST',
            success:function(data){
                coreJSON = $.parseJSON(data);                
            },      
            error: function() { 
                console.log("Error");  
            }
        });
    }
// *************************** [Display] ********************************************************************
    function dispGallery(JSON)
    {
        var i = 0;
       $('#datatable').dataTable( {
            "aaSorting":[],
            "aaData": JSON,
            "aoColumns": [
                { 
                    "mDataProp": function ( data, type, full, meta) {
                        return ++i;                        
                    }
                },
                { 
                    "mDataProp": function ( data, type, full, meta) {
                        return data.newstitle;
                        
                    }
                },
                { 
                    "mDataProp": function ( data, type, full, meta) {
                        if(data.image_url!==null)
                            return "<a href="+base_URL+data.image_url+" target='_blank'><img src="+base_URL+data.image_url+" alt='not-image' width=100></a>";
                        else
                            return '';
                    }
                },
                
                { 
                    "mDataProp": function ( data, type, full, meta) {
                        return  '<a id="'+ meta.row +'" class="btn btnEdit"><i class="mdi mdi-book-edit-outline"></i></a>'+
                                '<a id="'+ meta.row +'" class="btn BtnDelete"><i class="mdi mdi-trash-can"></i></a>';
                    }
                },              
            ]               
        });
    }    

    // *************************** [Image On Change] ********************************************************************
   
 $(document).on('change', '#image_url', function() {
        readURL(this);
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#user_uploaded_image').attr('src', e.target.result);
                $('#user_uploaded_image').css("display", "block");
                var tmppath = URL.createObjectURL(input.files[0]);           
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // *************************** [Edit] ********************************************************************

    $(document).on('click', '.btnEdit', function() {
        var r_index = $(this).attr("id");
        mode = "update";
        $('#myModal').modal('show');
        $('#newstitle_id').val(coreJSON[r_index].newstitle_id);
        $('#user_uploaded_image').attr("src", base_URL+coreJSON[r_index].image_url);
        $("#user_uploaded_image").addClass("active");
        $("#user_uploaded_image").css("display", "block");
        newsimage_id = coreJSON[r_index].newsimage_id;
    });

    // *************************** [Delete] ********************************************************************

    $(document).on('click','.BtnDelete',function(){
        mode="delete";
        var r_index = $(this).attr('id');
        newsimage_id  = coreJSON[r_index].newsimage_id;
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1
        }).then(function (e) {
            e.value ?
            $.ajax({
                type: "POST",
                url: base_URL+'admin/KaanalAdmin/delete_newsimage',
                data: {"newsimage_id":newsimage_id },
                success: function (data) {
                    var insertResult = $.parseJSON(data);
                    if(insertResult.status=="success")
                    {
                        $.confirm({
                            icon: 'icon-close',
                            title: 'congratulations..!',
                            content: insertResult['message'],
                            type: 'green',
                                buttons: {
                                    Ok: function() {
                                        location.reload();
                                    },
                                }
                        }); 
                        request.done(function (response){       
                            refreshDetails();
                        });
                    }
                    else{
                        $.confirm({
                          title: 'Encountered an error!',
                          content: insertResult['message'],
                          type: 'red',
                          typeAnimated: true,
                          buttons: {
                              tryAgain: {
                                  text: 'Try again',
                                  btnClass: 'btn-red',
                                  action: function(){
                                  }
                              },
                              close: function () {
                              }
                             
                          }
                      });
                      
                    }              
                },
            })
            :
            null
        })
    });

    // *************************** [Refresh] ********************************************************************
    
   function refreshDetails()
    {
        $.when(getGallery()).done(function(){
            var table = $('#datatable').DataTable();
            table.destroy();    
            dispGallery(coreJSON);               
        });     
    }

});