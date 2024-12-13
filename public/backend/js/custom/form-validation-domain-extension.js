"use strict";
function setMessSuccess(titleS="Auto close alert!",texts = 'You clicked the button!') {
    var timerInterval;
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: titleS,
        // text: texts,
        html:"<span class='badge bg-label-success rounded-pill'>"+ texts +"</span><br/>I will close in <strong></strong> seconds.",
        timer: 2000,
        customClass: {
            confirmButton: "btn btn-primary waves-effect waves-light",
        },
        buttonsStyling: false,
        willOpen: function () {
            Swal.showLoading();
            timerInterval = setInterval(function () {
                Swal.getHtmlContainer().querySelector("strong").textContent =
                    Swal.getTimerLeft();
            }, 100);
        },
        willClose: function () {
            clearInterval(timerInterval);
        },
    }).then(function (result) {
        if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.timer
        ) {
            console.log("I was closed by the timer");
        }
    });
}
$(function () {
    const dt_ajax_table = $(".datatables-ajax"),
        autoClose = document.querySelector("#auto-close");

    /* if (positionTopEnd) {
            positionTopEnd.onclick = function () {
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                  confirmButton: 'btn btn-primary waves-effect waves-light'
                },
                buttonsStyling: false
              });
            };
          } */

    // Auto Closing Alert
    /* if (autoClose) {
        autoClose.onclick = function () {
            var timerInterval;
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Auto close alert!",
                html: "<span class='badge bg-label-success rounded-pill'> asidahdjadh adsa jdadjahdjkah a dạ</span><br/>I will close in <strong></strong> seconds.",
                timer: 2000,
                customClass: {
                    confirmButton: "btn btn-primary waves-effect waves-light",
                },
                buttonsStyling: false,
                willOpen: function () {
                    Swal.showLoading();
                    timerInterval = setInterval(function () {
                        Swal.getHtmlContainer().querySelector(
                            "strong"
                        ).textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: function () {
                    clearInterval(timerInterval);
                },
            }).then(function (result) {
                if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.timer
                ) {
                    console.log("I was closed by the timer");
                }
            });
        };
    } */
    //// alert message save records

    dt_ajax_table.dataTable({
        processing: true,
        serverSide: false,
        pagingType: "full_numbers",
        // paging:   true,
        // "ordering": false,
        // createdRow: function(row, data, dataIndex, cells) {
        //     $(row).addClass('myRow');
        // },
        responsive: true,
        language: {
            lengthMenu: "_MENU_",
            url: assetsPath + "js/custom/vi.json",
        },
        // language: {
        // "lengthMenu": "Display _MENU_ records per page",
        // "zeroRecords": "No Data Found",
        // "info": "Total",
        // "infoEmpty": "No records available",
        // "infoFiltered": "(filtered from _MAX_ total records)",
        // "info": "Hiển thị _START_ tới _END_ của _TOTAL_ bản ghi",
        //     url: assetsPath + 'js/custom/vi.json'
        // },

        columnDefs: [
            {
                targets: 0,
                // orderable: false,
                render: function (data, type, full, meta) {
                    // console.log(full[2]);
                    if (type === "display") {
                        data =
                            '<input name="domains[]" type="checkbox" class="form-check-input" value="' +
                            full[1] +
                            '">';
                    }
                    return data;
                },
                checkboxes: {
                    selectRow: true,
                    selectAllRender:
                        '<input name="check_all" type="checkbox" id="flowcheckall" class="form-check-input"><label>&nbsp;All</label>',
                },
            },
        ],
        /* select: {
            // style:    'os',   //default but you have to specify it, no idea why
            style: "multi",
            selector: 'tr:not(.selected) td'
        }, */

        pageLength: dt_ajax_table.data("page-length") ?? 10,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        order: [[2, "desc"]],
        /*ajax: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: dt_ajax_table.data('url'),
            type: 'get',
        },
        */
        //   ajax: assetsPath + 'json/ajax.php',
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            paginate: {
                next: '<i class="ri-arrow-right-s-line"></i>',
                previous: '<i class="ri-arrow-left-s-line"></i>',
            },
        },
    });

    /* =====================table========================= */
    const select2Icons = $(".select2-icons"),
        select2 = $(".select2");

    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: $this.data("placeholder") ?? "Select value",
                allowClear: $this.data("allow-clear") ?? true,
                dropdownParent: $this.parent(),
            });
        });
    }

    // Select2 Icons
    if (select2Icons.length) {
        select2Icons.each(function () {
            var $thisIcon = $(this);
            // console.log($(this));
            // custom template to render icons
            function renderIcons(option) {
                if (!option.id) {
                    return option.text;
                }
                var $icon =
                    "<i class='" +
                    $(option.element).data("icon") +
                    " flag-icon'></i>&ensp;" +
                    option.text;
                //   var $icon = "<i class='" + $(option.element).data('icon') + " me-2'></i>" + option.text;
                return $icon;
            }
            select2Focus($thisIcon);
            $thisIcon.wrap('<div class="position-relative"></div>').select2({
                dropdownParent: $thisIcon.parent(),
                placeholder: $thisIcon.data("placeholder") ?? "Select value",
                language: "vn",
                allowClear: $thisIcon.data("allow-clear") ?? true,
                templateResult: renderIcons,
                templateSelection: renderIcons,
                escapeMarkup: function (es) {
                    return es;
                },
            });
        });
        /* function renderIcons(option) {
        if (!option.id) {
          return option.text;
        }
        var $icon = "<i class='" + $(option.element).data('icon') + " flag-icon'></i>&ensp;" + option.text;
      //   var $icon = "<i class='" + $(option.element).data('icon') + " me-2'></i>" + option.text;
        return $icon;
      }
      select2Focus(select2Icons);
      select2Icons.wrap('<div class="position-relative"></div>').select2({
        dropdownParent: select2Icons.parent(),
        placeholder: 'Select value',
        language: "vn",
        allowClear: $(this).data('allow-clear') ?? true,
        templateResult: renderIcons,
        templateSelection: renderIcons,
        escapeMarkup: function (es) {
          return es;
        }
      }); */
    }

    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $.validator.addMethod(
        "checkNameDot",
        function (value, element, event) {
            var result_dot = false;
            $.ajax({
                type: "POST",
                async: false,
                url: element.getAttribute("data-url"),
                data: {
                    id: element.getAttribute("data-id"),
                    name: value,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                // success: function (data) {
                //     // console.log(data);
                //     result_dot = data.code == 200 ? true : false;
                // },
                statusCode: {
                    200: function (data, textStatus) {
                        element.classList.add("is-valid");
                        result_dot = true;
                    },
                    201: function (data, textStatus) {
                        if (element.classList.contains("is-valid"))
                            element.classList.remove("is-valid");
                        result_dot = false;
                    },
                },
            });
            return result_dot;
        },
        "Đuôi tên miền này đã được sử dụng !"
    );

    $("form#form_domain_extension").validate({
        // errorClass: "invalid-feedback",
        // errorElement: "div",
        // errorElement: 'span',
        // errorClass: 'field-validation-error',
        // Specify validation rules
        // onsubmit: false,
        onkeyup: false,
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            // domain_extension_name: "required",
            // lastname: "required",
            // email: {
            //   required: true,
            //   // Specify that email should be validated
            //   // by the built-in "email" rule
            //   email: true
            // },
            domain_extension_name: {
                required: true,
                // minlength: 3,
                checkNameDot: true,
            },
        },
        // Specify validation error messages
        messages: {
            // domain_extension_name: "Vui lòng nhập tên đuôi mở rộng",
            // lastname: "Please enter your lastname",
            domain_extension_name: {
                required: "Vui lòng nhập tên đuôi mở rộng",
                // minlength: "Vui lòng nhập tên đusadadad 33  ôi mở rộng",
                // checkNameDot: "Đuôi tên miền này đã có trong CSDL",
            },
            // email: "Please enter a valid email address",
        },
        submitHandler: function (form, event) {
            // alert("Do some stuff...");
            $.ajax({
                url: form.getAttribute("action"),
                type: "POST",
                dataType: "html",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: $("#form_domain_extension").serializeArray(),
                // processData: false,
                // contentType: false,
                // success: function (data, status) {

                // console.log(form);
                // },
                statusCode: {
                    200: function (response, textStatus) {
                        console.log(response);
                        let data = response.split('{dotname}')
                        $('input[name="domain_extension_name"]').val("");
                        $('textarea[name="description"]').text("");
                        $('input[name="order"]').val("");
                        $("#domain_extension_items_list").append(data[0]);
                        $("#onboardImageModal").modal("hide");
                        setMessSuccess('Đuôi mở rộng thêm thành công !', 'Đuôi : '+ data[1] +' đã được thêm vào Database !')
                    },
                    201: function (data, textStatus) {
                        $('input[name="domain_extension_name"]').val("");
                        $('textarea[name="description"]').text("");
                        $('input[name="order"]').val("");
                        // $('#domain_extension_items_list').append(data)
                        $("#onboardImageModal").modal("hide");
                        setMessSuccess('Đuôi mở rộng thêm thành công !', 'Đuôi : '+ data +' đã được thêm vào Database !')
                    },
                    205: function (data, textStatus) {
                        console.log(data);
                    },
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                },
            });
            event.preventDefault();
        },
    });

    $.validator.addMethod(
        "domainNameExists",
        function (value, element, event) {
            var result_domain = false;
            $.ajax({
                type: "POST",
                async: false,
                url: element.getAttribute("data-url"),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    name: value,
                    id: element.getAttribute("data-id"),
                },
                dataType: "json",
                // success: function (data,statusCode) {
                //     console.log(data);
                //     console.log(statusCode);
                //     // result_domain = data.code == 200 ? true : false;
                // },
                statusCode: {
                    200: function (data, textStatus) {
                        result_domain = true;
                    },
                    201: function (data, textStatus) {
                        result_domain = false;
                    },
                },
            });
            return result_domain;
        },
        "Tên miền này đã được sử dụng !"
    );

    $("form#form_domain").validate({
        // errorClass: "invalid-feedback",
        // errorElement: "div",
        // errorElement: 'span',
        // errorClass: 'field-validation-error',
        // Specify validation rules
        // onsubmit: false,
        onkeyup: false,
        rules: {
            language_id: { required: true, min: 1 },
            domain_extension_id: { required: true, min: 1 },
            registration_date: { required: true },
            place_registration: { required: true },
            name: {
                required: true,
                // minlength: 3,
                domainNameExists: true,
            },
        },
        // Specify validation error messages
        messages: {
            // lastname: "Please enter your lastname",
            domain_extension_name: {
                required: "Vui lòng nhập tên đuôi mở rộng",
                domainNameExists: true,
            },
            language_id: {
                required: "Vui lòng chọn ngôn ngữ",
            },
            formValidationSelect2: {
                required: "Vui lòng chọn ngôn sadadadsa",
            },
            domain_extension_id: {
                required: "Vui lòng chọn đuôi mở rộng",
            },
            place_registration: {
                required: "Vui lòng nhập nơi đăng ký",
            },
            // email: "Please enter a valid email address",
        },
        // onkeyup: function(element) {
        //     if (!this.checkable(element)) {
        //         this.element(element);
        //     }
        // },
        submitHandler: function (form, event) {
            //    console.log(form);
            //     console.log($("#form_domain").serializeArray());
            // let count_tr = $('.datatables-ajax tbody tr').length
            $.ajax({
                url: form.getAttribute("action"),
                type: "POST",
                dataType: "html",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: $("#form_domain").serializeArray(),
                // processData: false,
                // contentType: false,
                success: function (response, status) {
                    $("#domainModal").modal("hide");
                    let data = response.split("{**}");
                    // setMessSuccess('Tên miền thêm thành công !', 'Đuôi : '+ data.name +' đã được thêm vào Database !')
                    // console.log('#' + data[1]);
                    // console.log($("#" + data[1]).length > 0);
                    if ($("#" + data[1]).length) {
                        $("#" + data[1]).html(data[0]);
                    } else {
                        $("#domain_items_list").append(data[0]);
                        console.log(data[0]);
                    }
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                },
            });
            event.preventDefault();
        },
    });

    $(document).ready(function () {
        $("#domain_extension_id").on("change", function () {
            $("#form_domain").validate().element("#domain_extension_id");
        });
        $("#select2Icons-language_id").on("change", function () {
            $("#form_domain").validate().element("#select2Icons-language_id");
        });
        let bsDatepickerAutoclose = $("#bs-datepicker-autoclose");
        // Auto close
        if (bsDatepickerAutoclose.length) {
            bsDatepickerAutoclose.datepicker({
                todayHighlight: true,
                autoclose: true,
                format: "yyyy-mm-dd",
                calendarWeeks: true,
                clearBtn: true,
                orientation: isRtl ? "auto right" : "auto left",
            });
        }
        /* let bsDatepickerRange = $("#bs-datepicker-daterange");
        // Range
        if (bsDatepickerRange.length) {
            bsDatepickerRange.datepicker({
                // multidate: true,
                // minDate: '1y',
                // maxDate: '+1y',
                todayHighlight: true,
                format: "yyyy-mm-dd",
                calendarWeeks: true,
                clearBtn: true,
                // ranges: {
                //     Today: [moment(), moment()],
                //     Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                //     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                //     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                //     'This Month': [moment().startOf('month'), moment().endOf('month')],
                //     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                // },
                orientation: isRtl ? "auto right" : "auto left",
            });
        } */

        $("#filter-domain-component").submit(function (e) {
            let data = $(this).serializeArray(),
                currentUrl = $(this).attr("action");
            const result = {
                status: [],
                publish: [],
                domain_extension_id: [],
                language_id: [],
            };
            var checkdata = false;
            $.each(data, function (i, field) {
                if (field.value > 0 && checkdata === false) {
                    checkdata = true;
                }
                if (field.name == "status[]") {
                    result.status.push(field.value);
                }
                if (field.name == "publish[]") {
                    result.publish.push(field.value);
                }
                if (field.name == "domain_extension_id[]") {
                    result.domain_extension_id.push(field.value);
                }
                if (field.name == "language_id[]") {
                    result.language_id.push(field.value);
                }
            });
            // console.log(currentUrl);
            // $(this).attr('action') +
            let newUrl =
                "?status=" +
                result.status.toString() +
                "&publish=" +
                result.publish.toString() +
                "&domain_extension_id=" +
                result.domain_extension_id.toString() +
                "&language_id=" +
                result.language_id.toString();
            // newUrl = replaceUrlParam(newUrl,'publish',result.publish);
            // console.log(location.host.split(":")[0]);
            // console.log(addParam(currentUrl,'status',result.status));
            setTimeout(function () {
                $(location).attr("href", newUrl);
                window.location.href = newUrl;
            }, 800);

            // window.location.assign(newUrl)
            e.preventDefault();
        });

        /* check all checkbox table */
        $("#flowcheckall").click(function () {
            // console.log(this.checked);
            if (this.checked) {
                $('input[name="domains[]"]:not(:checked)').trigger("click");
            } else {
                // ('input[name=input_name]').is(':checked')
                $('input[name="domains[]"]:checked').trigger("click");
            }
        });
        /* check all checkbox table */

        $("#domainModal").on("hidden.bs.modal", function (e) {
            $('#form_domain input[type="text"]').val("");
            $('#form_domain input[type="number"]').val("");
            $("#form_domain select.form-select").val(null).trigger("change");
            $("#form_domain textarea").text("");
        });
    });
});
