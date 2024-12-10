function editItem(e,id) {
    let beforeAction = $('#form_domain').attr("action");
    $.ajax({
        url: e.getAttribute("data-url"),
        type: "POST",
        dataType: "JSON",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        // data: {
        //     _token: _token,
        // },
        beforeSend: function() {
            $('#form_domain').attr('action',e.getAttribute("data-action"))
            // currentLink.html('loading...')
        },
        success: function (data) {
            
        },
        complete: function (data) {
            // $('#form_domain').attr('action',beforeAction)
        },
        statusCode: {
            200: function (response) {
                let domain = response.data
                $('#domain-name').val(domain.name).attr('data-id',id)
                $('#select2Icons-language_id').val(domain.language_id).trigger("change")
                $('#domain_extension_id').val(domain.domain_extension_id).trigger("change")
                $('#bs-datepicker-autoclose').val(domain.date_of_registration)
                $('#multicol-year_of_extended').val(domain.year_of_extended)
                $('#multicol-place_registration').val(domain.place_registration)
                $('#domain_order').val(domain.order)
                $('#multicol-content').text(domain.content)
                $('#switch-publish-'+domain.publish).prop("checked", true)
                $('#switch-status-'+domain.status).prop("checked", true)
                // console.log(response);
                $("#domainModal").modal("show");
                $('#domainModal').on('hidden.bs.modal', function (e) {
                    $('#form_domain').attr('action',beforeAction)
                })
            },
            201: function (response) {
                console.log(response);
                // console.log(response.responseJSON.message);
                // message = response.responseJSON.message
                // if (isNaN(message)) message = "Bạn đã xóa thất bại";
                
            }
        },
        error: function (error) {
            
            console.log(error);
            // currentLink.html('loading...')
        }
    });
}
function deleteItem(e,id) {
    let attrMessage = e.getAttribute("data-message"),
        attrTitle = e.getAttribute("data-title"),
        titleMessage = e.getAttribute("data-message") ?? "Bạn xóa có thể những dữ liệu khác ảnh hưởng ?",
        titleHead = e.getAttribute("data-title") ?? "Bạn muốn xóa ?"

    // if (item.data("action") == "show") {
    //     action = "show";
    // } else {
    //     action = false;
    // }

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "mr-2 btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons
        .fire({
            title: titleHead,
            text: titleMessage,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        })
        .then(result => {
            if (result.value) {
                $.ajax({
                    url: e.getAttribute("data-url"),
                    type: "DELETE",
                    dataType: "JSON",
                    // data: {
                    //     _token: _token,
                    // },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    // beforeSend: function() {
                    //     currentLink.html('loading...')
                    // },
                    success: function (data) {
                        
                    },
                    statusCode: {
                        200: function (response) {
                            console.log(response);
                            $('#domain_item_'+id).remove()
                            //  Swal.fire({
                            //     position: "top-end",
                            //     icon: "success",
                            //     title: "Your work has been saved",
                            //     showConfirmButton: false,
                            //     timer: 1500
                            //   });

                            swalWithBootstrapButtons.fire(
                                "success",
                                response.message,
                                "success",
                                1500
                            );
                        },
                        403: function (response) {
                            // console.log(response);
                            console.log(response.responseJSON.message);
                            message = response.responseJSON.message
                            if (isNaN(message)) message = "Bạn đã xóa thất bại";
                            swalWithBootstrapButtons.fire(
                                "Error !",
                                message,
                                "error"
                            );
                        }
                    },
                    error: function (response) {
                        swalWithBootstrapButtons.fire(
                            "Error !",
                            "bạn đã xóa thất bại ",
                            "warning"
                        );
                        // currentLink.html('loading...')
                    }
                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)",
                    "error"
                );
            }
        });
}

function changeActive(e, id) {
    let item = $("#changeActive_" + id);
    let titleMessage = "",
        titleHead = "",
        attrMessage = item.attr("data-message"),
        attrTitle = item.attr("data-title");

    if (typeof attrTitle === typeof undefined || attrTitle === false) {
        titleHead = "Bạn muốn thay đổi ?";
    } else {
        titleHead = attrTitle;
    }
    if (typeof attrMessage === typeof undefined || attrMessage === false) {
        titleMessage = "Bạn xóa có muốn thay đổi trạng thái ?";
    } else {
        titleMessage = attrMessage;
    }
    let urlRequest = e.getAttribute("data-url"),
        field = e.getAttribute("data-field"),
        _token = $("input[name=_token]").val();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "mr-2 btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons
        .fire({
            title: titleHead,
            text: titleMessage,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, change it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        })
        .then(result => {
            if (result.value) {
                $.ajax({
                    url: urlRequest,
                    type: "GET",
                    // dataType: 'JSON',
                    data: {
                        id: id,
                        field: field,
                        _token: _token
                    },
                    beforeSend: function () {
                        // item.html("loading...");
                    },
                    statusCode: {
                        200: function (response) {
                            switch (field) {
                                case "status":
                                    message = "Bạn đã thay đổi trạng thái thành công";
                                    break;
                                case "vertical_menu":
                                    message = "Bạn đã thay đổi trạng thái thành công";
                                    break;
                            
                                default:
                                    message = "Bạn đã xóa thất bại";
                                    break;
                            }
                            
                            item.html(response);
                            swalWithBootstrapButtons.fire(
                                "Changed !",
                                message,
                                "success"
                            );
                        },
                        201: function (response) {
                            // console.log(response);
                            // console.log(response);
                            // message = response.responseJSON.message

                            // swalWithBootstrapButtons.fire(
                            //     "Error !",
                            //     response,
                            //     "error"
                            // );
                        },
                        403: function (response) {
                            // console.log(response);
                            // console.log(response);
                            message = response.responseJSON.message

                            swalWithBootstrapButtons.fire(
                                "Error !",
                                message,
                                "error"
                            );
                        }
                    },
                    success: function (data) {

                    },
                    error: function (error) {
                        // console.log(error);
                        // console.log(response.message);
                        swalWithBootstrapButtons.fire(
                            "Error !",
                            "Your data fail change .",
                            "warning"
                        );
                        // currentLink.html('loading...')
                    }
                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                //     "Cancelled",
                //     "Your imaginary file is safe :)",
                //     "error"
                // );
            }
        });
}

 /* SỬ DỤNG LOAD AJAX TRONG MODAL  */
 let select2LoadAjax = $(".select2.mySelect2Ajax");
 select2LoadAjax.each(function () {
     let that = $(this),
         drop_parent = false;
     /* kiểm tra có phải nằm trong Modal #myModalModalLG */
     if ($(this).parents("#myModalModalLG ").length) {
         drop_parent = $("#myModalModalLG");
     }
     // console.log(dropdownParent);
     $(this).select2({
         // theme: "bootstrap4",
         placeholder: $(this).data("placeholder"),
         allowClear: Boolean($(this).data("allow-clear")),
         // debug: true
         // placeholder: "--Select a..--",
         dropdownParent: drop_parent,
         ajax: {
             url: that.data("url"),
             dataType: "json",
             type: "GET",
             quietMillis: 50,
             // delay: 250,
             data: function (params) {
                 var queryParameters = {
                     name: params.term
                 };
                 return queryParameters;
             },
             processResults: function (data) {
                 return {
                     // results: data
                     results: $.map(data, function (item) {
                         return {
                             text: item.name,
                             id: item.id
                         };
                     })
                 };
             }
         }
     });
 });

 /* SỬ DỤNG LOAD AJAX TRONG MODAL myModalModalLG */
