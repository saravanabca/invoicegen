$(document).ready(function () {
    var coreJSON, user_id, mode;
    $.when(getGallery()).done(function () {
        dispGallery(coreJSON);
        // console.log(coreJSON);
    });
    // alert();
    $(".validate_border").hide();

    $("#addNew").click(function () {
        mode = "new";
        $("#user_uploaded_image").css("display", "none");
        $("#myModal").modal("show");
    });

    // *************************** [Validation] ********************************************************************
    $("#formSubmit").click(function (e) {
        mode = "new";

        $(".invalid-feedback").hide();
        // e.preventDefault();
// alert();
        if ($("#template_name").val() == "" && mode == "new") {
            $(".template_name").html("Please Enter template name").show();
        }  else {
            // return;
            saveGallery();
        }
    });
    // *************************** [Insert and Update] ********************************************************************

    function saveGallery() {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var editor = $('#editor').val();
        var imageUrls = [];
        var $content = $('<div>').html(editor);

        $content.find('img').each(function() {
            var imgUrl = $(this).attr('src');
            imageUrls.push(imgUrl);
        });

        console.log(imageUrls);
        // return;
        var form = $("#formModal")[0];
        var data = new FormData(form);
        // console.log(editor);
        // return;
        data.append("image_url",editor);
        data.append("image_urls",imageUrls);

        // return;
        // var formData = new FormData(this);
        // alert(formData);
        if (mode == "new") {
            var url = base_Url + "/admin_template_add";
        } else if (mode == "update") {
            var url = base_Url + "/admin_template_update";
            data.append("user_id", user_id);
        }
        // return;
        request = $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: url,
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken, // Include CSRF token in the headers
            },
            success: function (data) {
                // alert("success",data);
                // // return;
                // var insertResult = $.parseJSON(data);

                if (data.success) {
                    $.confirm({
                        icon: "icon-close",
                        title: "congratulations...!",
                        content: "Updated Sucessfully",
                        type: "green",
                        buttons: {
                            Ok: function () {
                                location.reload();
                            },
                        },
                    });
                    // request.done(function (response){
                    //     $('#myModal').modal('hide');
                    //     refreshDetails();
                    // });
                } else {
                    $.confirm({
                        title: "Encountered an error!",
                        content: data.message,
                        type: "red",
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: "Try again",
                                btnClass: "btn-red",
                                action: function () {},
                            },
                            close: function () {},
                        },
                    });
                }
            },
            error: function (data) {
                alert("fail", data);
            },
        });
    }

    $("#myModal").on("show.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $(".invalid-feedback").hide();
    });

    // ***************************[Get] ********************************************************************

    // $(document).ready(function () {
    //     // alert();
    //     $.ajax({
    //         url: base_Url + "/admin_template_get",
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

    function getGallery() {
        return $.ajax({
            url: base_Url + "/admin_template_get",
            type: "GET",
            success: function (data) {
                coreJSON = data.templatedata;
            },
            error: function () {
                console.log("Error");
            },
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
                    mData: function (data, type, full, meta) {
                        return ++i;
                    },
                },
                {
                    mData: function (data, type, full, meta) {
                        return data.template_name;
                    },
                },
                {
                    mDataProp: function (data, type, full, meta) {
                        if (data.image_url !== null)
                            return (
                                "<a href=" +
                                base_Url +
                                data.image_url +
                                " target='_blank'><img src=" +
                                base_Url +
                                data.image_url +
                                " alt='not-image' width=100></a>"
                            );
                        else return "";
                    },
                },

                {
                    mData: function (data, type, full, meta) {
                        // console.log(data.id);
                        return (
                            '<div class="others_icons"><a class="btnEdit" id="' +
                            meta.row +
                            '"><img src="' +
                            base_Url +
                            '/images/invoicelist/edit.png" id="" alt=""></a>' +
                            '<img src="' +
                            base_Url +
                            '/images/invoicelist/delete.png" class="delete_invoice BtnDelete" id="' +
                            meta.row +
                            '" alt=""></div>'
                        );
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
    // *************************** [Image On Change] ********************************************************************

    $(document).on("change", "#image_url", function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#user_uploaded_image").attr("src", e.target.result);
                $("#user_uploaded_image").css("display", "block");
                var tmppath = URL.createObjectURL(input.files[0]);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // *************************** [Edit] ********************************************************************

    $(document).on("click", ".btnEdit", function () {
        var r_index = $(this).attr("id");
        mode = "update";
        // alert(r_index);
        // var editdata = coreJSON.clientdetails;
        // console.log(editdata);
        $("#myModal").modal("show");
        $("#template_name").val(coreJSON[r_index].template_name);

        $("#user_uploaded_image").attr(
            "src",
            base_Url + coreJSON[r_index].image_url
        );
        $("#user_uploaded_image").addClass("active");
        $("#user_uploaded_image").css("display", "block");
        user_id = coreJSON[r_index].id;
    });

    // *************************** [Delete] ********************************************************************

    $(document).on("click", ".BtnDelete", function () {
        mode = "delete";
        var r_index = $(this).attr("id");
        user_id = coreJSON[r_index].id;
        // alert(user_id);
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1,
        }).then(function (e) {
            e.value
                ? $.ajax({
                      type: "POST",
                      url: base_Url + "/admin_template_delete",
                      data: { user_id: user_id },
                      headers: {
                          "X-CSRF-TOKEN": csrfToken, // Include CSRF token in the headers
                      },
                      success: function (data) {
                          // alert("success",data);
                          // // return;
                          // var insertResult = $.parseJSON(data);

                          if (data.success) {
                              $.confirm({
                                  icon: "icon-close",
                                  title: "congratulations...!",
                                  content: "Updated Sucessfully",
                                  type: "green",
                                  buttons: {
                                      Ok: function () {
                                          location.reload();
                                      },
                                  },
                              });
                              // request.done(function (response){
                              //     $('#myModal').modal('hide');
                              //     refreshDetails();
                              // });
                          } else {
                              $.confirm({
                                  title: "Encountered an error!",
                                  content: data.message,
                                  type: "red",
                                  typeAnimated: true,
                                  buttons: {
                                      tryAgain: {
                                          text: "Try again",
                                          btnClass: "btn-red",
                                          action: function () {},
                                      },
                                      close: function () {},
                                  },
                              });
                          }
                      },
                      error: function (data) {
                        $.confirm({
                            title: "Encountered an error!",
                            content: "server error",
                            type: "red",
                            // typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: "Try again",
                                    btnClass: "btn-red",
                                    action: function () {},
                                },
                                close: function () {},
                            },
                        });
                      },
                  })
                : null;
        });
    });

    // *************************** [Refresh] ********************************************************************

    function refreshDetails() {
        $.when(getGallery()).done(function () {
            var table = $("#datatable").DataTable();
            table.destroy();
            dispGallery(coreJSON);
        });
    }

    // *************************** [Template Edit] ********************************************************************

    $(document).ready(function () {
  
            let selectedTable, selectedRow, selectedCell;

            function applyStyle(styleProperty, value) {
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    const span = document.createElement('span');
                    span.style[styleProperty] = value;
                    span.appendChild(range.extractContents());
                    range.insertNode(span);
                }
            }

            function applyStyleAlign(value) {
                // console.log(styleProperty);
                const selection = window.getSelection();
                console.log(selection);
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    const span = document.createElement('div');
                    if (value === 'left') {
                        span.style.textAlign = 'left';
                    } else if (value === 'right') {
                        span.style.textAlign = 'right';
                    } 
                    // span.style[styleProperty] = value;
                    span.appendChild(range.extractContents());
                    range.insertNode(span);
                }
            }

            function applyTag(tag) {
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    const element = document.createElement(tag);
                    element.appendChild(range.extractContents());
                    range.insertNode(element);
                }
            }

            function applyTextCommand(command) {
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    const span = document.createElement('span');
                    if (command === 'bold') {
                        span.style.fontWeight = 'bold';
                    } else if (command === 'italic') {
                        span.style.fontStyle = 'italic';
                    } else if (command === 'underline') {
                        span.style.textDecoration = 'underline';
                    } else if (command === 'justifyLeft') {
                        span.style.textAlign = 'left';
                    } else if (command === 'justifyCenter') {
                        span.style.textAlign = 'center';
                    } else if (command === 'justifyRight') {
                        span.style.textAlign = 'right';
                    }
                    span.appendChild(range.extractContents());
                    range.insertNode(span);
                }
            }

            // Use event delegation for dynamically added elements
            $(document).on('click', '.toolbar button', function () {
                // alert();
                const command = $(this).data('command');
                applyTextCommand(command);
            });


            $('#textalignSelector').change(function () {
                const selectedAlign = $(this).val();
                // console.log(selectedAlign);
                applyStyleAlign(selectedAlign);
            });

            $('#uploadImageButton').click(function () {
                $('#imageUpload').click();
            });

            // $('#imageUpload').change(function () {
            //     const file = this.files[0];
            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = function (e) {
            //             const img = document.createElement('img');
            //             img.src = e.target.result;
            //             $('.editor').append(img);
            //         };
            //         reader.readAsDataURL(file);
            //     }
            // });



            $('#imageUpload').on('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = $('<img>').attr('src', e.target.result).css({
                            'max-width': '100%',
                            'max-height': '100%',
                            'display': 'block',
                            'margin': '10px 0'
                        }).addClass('editor-image');
                        
                        const controls = $('<div>').addClass('image-controls')
                            .html(`
                                <button type="button" class="align-left">Left</button>
                                <button type="button" class="align-center">Center</button>
                                <button type="button" class="align-right">Right</button>
                                <button type="button" class="zoom-in">Zoom In</button>
                                <button type="button" class="zoom-out">Zoom Out</button>
                                <button type="button" class="delete">Delete</button>
                            `);
        
                        const wrapper = $('<div>').css('position', 'relative');
                        wrapper.append(img).append(controls);
                        $('.editor').append(wrapper);
        
                        img.on('mouseenter', function () {
                            controls.show();
                        })
        
                        controls.on('mouseenter', function () {
                            $(this).show();
                        })
        
                        controls.on('click', 'button', function () {
                            const action = $(this).attr('class');
                            switch (action) {
                                case 'align-left':
                                    img.css('float', 'left');
                                    break;
                                case 'align-center':
                                    img.css({'float': 'none', 'margin': '0 auto', 'display': 'block'});
                                    break;
                                case 'align-right':
                                    img.css('float', 'right');
                                    break;
                                case 'zoom-in':
                                    img.css('transform', 'scale(' + (img.data('scale') || 1.0) * 1.1 + ')');
                                    img.data('scale', (img.data('scale') || 1.0) * 1.1);
                                    break;
                                case 'zoom-out':
                                    img.css('transform', 'scale(' + (img.data('scale') || 1.0) * 0.9 + ')');
                                    img.data('scale', (img.data('scale') || 1.0) * 0.9);
                                    break;
                                case 'delete':
                                    wrapper.remove();
                                    break;
                            }
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#tagSelector').change(function () {
                const selectedTag = $(this).val();
                applyTag(selectedTag);
            });


           

            $('#convertToHtml').click(function () {
                const htmlContent = $('.editor').html();
                $('#htmlOutput').text(htmlContent);
            });

            // Insert table
            $('#insertTableButton').click(function () {
                const table = $('<table><tbody><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table>');
                $('.editor').append(table);
                addTableListeners(table);
            });

            // Add row to table
            $('#addRowButton').click(function () {
                if (selectedTable) {
                    const row = $('<tr><td>&nbsp;</td><td>&nbsp;</td></tr>');
                    selectedTable.find('tbody').append(row);
                    addRowListeners(row);
                } else {
                    alert('Please select a table first.');
                }
            });

            // Add column to table
            $('#addColumnButton').click(function () {
                if (selectedTable) {
                    selectedTable.find('tr').each(function () {
                        $(this).append('<td>&nbsp;</td>');
                    });
                } else {
                    alert('Please select a table first.');
                }
            });

            // Delete selected row
            $('#deleteRowButton').click(function () {
                if (selectedRow) {
                    selectedRow.remove();
                } else {
                    alert('Please select a row first.');
                }
            });

            // Delete selected column
            $('#deleteColumnButton').click(function () {
                if (selectedCell) {
                    const columnIndex = selectedCell.index();
                    selectedTable.find('tr').each(function () {
                        $(this).find('td').eq(columnIndex).remove();
                    });
                } else {
                    alert('Please select a column first.');
                }
            });

            // Add listeners to the table and its rows
            function addTableListeners(table) {
                table.click(function (e) {
                    e.stopPropagation();
                    selectedTable = $(this);
                });
                table.find('tr').each(function () {
                    addRowListeners($(this));
                });
            }

            function addRowListeners(row) {
                row.click(function (e) {
                    e.stopPropagation();
                    selectedRow = $(this);
                    selectedCell = $(e.target).closest('td');
                });
            }

            // Background color change
            $('#bgColorPicker').change(function () {
                const color = $(this).val();
                $('.editor').css('background-color', color);
            });

            // Background image upload
            $('#uploadBgImageButton').click(function () {
                $('#bgImageUpload').click();
            }); 


            $('#bgImageUpload').change(function (e) {
                // e.preventDefault();
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const bgImage = e.target.result;
                        console.log(bgImage);
                        $('.editor').css('background-image', `url(${bgImage})`);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Text color change
            $('#textColorPicker').change(function () {
                const color = $(this).val();
                applyStyle('color', color);
            });

           
   
    });
      

});
