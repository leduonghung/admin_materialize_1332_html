"use strict";
$(function () {
    const dt_ajax_table = $(".datatables-ajax");

    /* $("#example tr").click( function(event) {
        var target = $(event.target);
        if(!target.is(":nth-of-type(4)") {
            $(this).toggleClass('row_selected');
        }
    }) */
   console.log(assetsPath + 'js/custom/vi.json');
   dt_ajax_table.dataTable({
        processing: true,
        serverSide: false,
        // pagingType: "full_numbers",
        // paging:   true,
        // "ordering": false,
        // createdRow: function(row, data, dataIndex, cells) {
        //     $(row).addClass('myRow');
        // },
        responsive: true,
        language: {
            "lengthMenu": "_MENU_",
            url: assetsPath + 'js/custom/vi.json'
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
        layout: {
            topStart : { pageLength : { text : "Show _MENU_ articles per page" } },
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            }
        },
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    // console.log(meta);
                    if (type === "display") {
                        data = '<input type="checkbox" class="form-check-input">';
                    }
                    return data;
                },
                checkboxes: {
                    selectRow: true,
                    selectAllRender:
                        '<input type="checkbox" class="form-check-input"><label>&nbsp;All</label>',
                },
            },
        ],
        /* select: {
            // style:    'os',   //default but you have to specify it, no idea why
            style: "multi",
            selector: 'tr:not(.selected) td'
        },
         */
        pageLength: dt_ajax_table.data("page-length") ?? 10,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
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
    }) 
    
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
                url: "/domain/extension/exists",
                data: {
                    name: value,
                    _token: $("meta[name=csrf-token]").attr("content"),
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    result_dot = data.code == 200 ? true : false;
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
            // console.log($("#form_domain_extension").serialize());
            $.ajax({
                url: "/domain/extension/store",
                type: "POST",
                dataType: "JSON",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: $("#form_domain_extension").serializeArray(),
                // processData: false,
                // contentType: false,
                success: function (data, status) {
                    $('input[name="domain_extension_name"]').val("");
                    $('textarea[name="description"]').text("");
                    $('input[name="order"]').val("");
                    $("#onboardImageModal").modal("hide");
                    // console.log(form);
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                },
            });
            event.preventDefault();
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        // submitHandler: function (form, event) {

        // 	alert("Do some stuff...");

        // 	event.preventDefault();
        // 	console.log($("#form_domain_extension").serializeArray());
        //     $.ajax({
        //         url: '/domain/extension/store',
        //         type: "POST",
        //         dataType: "JSON",
        //         data: $("#form_domain_extension").serializeArray(),
        //         processData: false,
        //         contentType: false,
        //         success: function (data, status) {
        // 			console.log(data);
        // 		},
        //         error: function (xhr, desc, err) {
        //             console.log("error");
        //         },
        //     });
        // form.submit();
        // 	// $(form).ajaxSubmit();

        //     // console.log(data.entries());
        // },
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
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    result_domain = data.code == 200 ? true : false;
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
                success: function (data, status) {
                    // $('#form_domain input[name="domain_extension_name"]').val("");
                    // $('textarea[name="description"]').text("");
                    // $('input[name="order"]').val("");
                    $("#domainModal").modal("hide");
                    // console.log(data);
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
        let bsDatepickerRange = $("#bs-datepicker-daterange");
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
        }

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

        // $('#datatables-ajax tbody tr').on( 'click',  function () {
        //     if ( $(this).hasClass('selected') ) {
        //         $(this).removeClass('selected');
        //     } else {
        //         table.$('tr.selected').removeClass('selected');
        //         console.log($(this).text());
        //         $(this).addClass('selected').css('color', 'red');
        //     }
        // });
    });
});
