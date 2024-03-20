$(document).ready(function() {
    $("#refresh-table").click(function() {
        if (table != "") {
            table.ajax.reload();
            return;
        }
    });

    $("#submit-filter").submit(function(e) {
        e.preventDefault();

        let count = parseInt($("#count").val());

        for (let i = 1; i <= count; i++) {
            let {
                id,
                value
            } = e.currentTarget[i];

            if (value != '' || value != null) addOrUpdateParams(id, value);
        }

        if (table != "") {
            table.ajax.reload();
            return;
        }
    });

    $("#reset-filter").click(function() {
        $("#submit-filter").trigger("reset");

        history.pushState(null, "", window.location.pathname);

        $(".select2").val("").trigger("change");
        if (table != "") {
            table.ajax.reload();
        }
    });
})

function validate_keypress(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

function datePicker(start_date = "", end_date = "", add_params = true) {
    if(add_params) {
        addOrUpdateParams("date-start", start_date.val());
        addOrUpdateParams("date-end", end_date.val());
    }

    start_date
        .datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date(2022, 1, 0),
            endDate: "+0d",
            uiLibrary: 'bootstrap4'
        })
        .on("changeDate", function(ev) {
            var newDate = moment(ev.date, "DD-MM-YYYY");
            end_date.datepicker(
                "setStartDate",
                new Date(
                    newDate.format("YYYY"),
                    newDate.format("M") - 1,
                    newDate.format("D")
                )
            );
        });

    end_date
        .datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date(2022, 1, 0),
            endDate: datepicker_endDate,
            uiLibrary: 'bootstrap4'
        })
        .on("changeDate", function(ev) {
            var newDate = moment(ev.date, "DD-MM-YYYY");
            start_date.datepicker(
                "setEndDate",
                new Date(
                    newDate.format("YYYY"),
                    newDate.format("M") - 1,
                    newDate.format("D")
                )
            );
        });
}

function deleteData(route = "") {
    $(document).on("click", "#form-delete", function (e) {
        e.preventDefault();

        let id = $("#id").val();

        let url = e.currentTarget.action;

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                if ($(this).data("requestRunning")) {
                    return;
                }

                $(this).data("requestRunning", true);

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    url,
                    type: "DELETE",
                    data: {
                        id: id,
                    },
                })
                    .then((response) => {
                        if (response.status == 200) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }

                        if (response.type == "redirect" && route != "") {
                            setTimeout(() => {
                                window.location = route;
                            }, 1500);
                        } else {
                            table.ajax.reload();
                        }

                        $(this).data("requestRunning", false);
                    })
                    .catch((error) => {
                        toastr.error("Server Error");
                        $(this).data("requestRunning", false);
                    });
            }
        });
    });
}


async function save(
    forms,
    form,
    formData,
    route = "",
    additional_data = null,
    content_type = false
) {
    if ($("#submit-button").data("requestRunning")) {
        return;
    }

    $("#submit-button").data("requestRunning", true);

    await $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: form.attr("action"),
        type: form.attr("method"),
        contentType: content_type,
        processData: false,
        cache: false,
        data: formData,
        dataType: "json",
    })
        .then((response) => {
            successSubmit(response, route);
        })
        .catch((error) => {
            validationError(forms, form, error, additional_data);
        });
}

function fetchingValueOnChanges(forms) {
    Object.keys(forms).forEach((field) => {
        forms[field].attribute.change(function (e) {
            forms[field].value = e.target.value;
            validationOnType(forms[field]);
        });
    });
}

function validationOnType({ type = "", label, field, value }) {
    let rule = null;
    let message = "";

    switch (type) {
        case "text":
            rule = /^[a-zA-Z-. ]*$/;
            message = `${label} only accepts text values !`;
            isMatch(rule, value, field, message);
            break;
        case "number":
            rule = /^[0-9]+$/;
            message = `${label} only accepts number values !`;
            isMatch(rule, value, field, message);
            break;
        case "phone":
            rule = /^[0-9]+$/;
            message = `${label} format is not valid !`;
            isMatch(rule, value, field, message);
            break;
        case "fax":
            rule = /^\+?[0-9]{7,}$/;
            message = `${label} format is not valid !`;
            isMatch(rule, value, field, message);
            break;
        default:
            removeErrorMessage(field);
            showButtons();
            break;
    }
}

function successSubmit(response, route) {
    if (response.status == 200 || response.status == 201) {
        toastr.success(response.message);
        if (route != "") {
            setTimeout(() => {
                window.location = route;
            }, 1500);
        } else {
            $(".modal").modal("hide");
        }
    } else {
        if (typeof response.message == "object") {
            response.message.map((data) => {
                let row = data.row;

                data.errors.map((val) => {
                    let error_message = `${val} on row ${row}`;
                    toastr.error(error_message);
                });
            });
        } else {
            toastr.error(response.message);
        }
    }

    $("#submit-button").data("requestRunning", false);
}

function addOrUpdateParams(key, value) {
    let searchParams = new URLSearchParams(window.location.search);

    searchParams.set(key, value);
    const newURL = window.location.pathname + "?" + searchParams.toString();

    history.pushState(null, "", newURL);
}

function removeButtons() {
    $("#back-button").css("display", "none");
    $("#submit-button").attr("disabled", true);
}

function setForms(forms, boolean = true) {
    Object.keys(forms).forEach((form) => {
        forms[form].attribute.attr("disabled", boolean);
    });
}

function isMatch(rule, value, field, message) {
    if (!value.match(rule)) {
        $(`#${field}-error`).text(message);
        $(`#${field}`).addClass("is-invalid");
        return;
    }
    removeErrorMessage(field);
}


function validateJS(forms, error_msg) {
    setForms(forms);
    Object.keys(forms).map((form) => {
        let { validationRules } = forms[form];

        if (validationRules != undefined) {
            Object.keys(validationRules).map((rule) => {
                switch (rule) {
                    case "required":
                        isRequired(
                            forms[form],
                            validationRules[rule],
                            error_msg
                        );
                        break;
                    case "min":
                        minLength(
                            forms[form],
                            validationRules[rule],
                            error_msg
                        );
                        break;
                    case "max":
                        maxLength(
                            forms[form],
                            validationRules[rule],
                            error_msg
                        );
                        break;
                    default:
                        removeErrorMessage(forms[form].field);
                        break;
                }
            });
        }
    });
}


function validationError(forms, form, error, editors = null) {
    setForms(forms, false);
    switch (error.status) {
        case 422:
            const errors = [];
            for (const validation in error.responseJSON.errors) {
                let input = form.find(`[id=${validation}]`);

                errors.push(validation);
                let validationMessage = document.querySelector(
                    "#" + validation + "-error"
                );

                input[0].classList.add("is-invalid");
                input[0].parentElement.classList.add("has-error");

                if (validationMessage != null)
                    validationMessage.innerText = error.responseJSON.errors[
                        validation
                    ][0].replaceAll("-", " ");

                input[0].addEventListener("keyup", function (event) {
                    if (event.target.value !== "") {
                        event.target.classList.remove("is-invalid");
                        event.target.parentElement.classList.remove(
                            "has-error"
                        );
                        event.target.nextElementSibling.innerText = "";
                    } else {
                        event.target.classList.add("is-invalid");
                        event.target.parentElement.classList.add("has-error");
                        event.target.nextElementSibling.innerText =
                            error.responseJSON.errors[event.target.name][0];
                    }
                });

                if (editors) {
                    editors.on("change", function (event) {
                        if (editors.getData() != "") {
                            $("#editors")[0].classList.remove("is-invalid");
                            $(
                                "#editors"
                            )[0].nextElementSibling.nextElementSibling.innerText =
                                "";
                            $("#editors")[0].parentElement.classList.remove(
                                "has-error"
                            );
                        } else {
                            $("#editors")[0].classList.add("is-invalid");
                            $("#editors")[0].parentElement.classList.add(
                                "has-error"
                            );
                            $(
                                "#editors"
                            )[0].nextElementSibling.nextElementSibling.innerText =
                                error.responseJSON.errors["body"][0];
                        }
                    });

                    const select2 = $(".select2");

                    if (select2) {
                        select2.on("select2:open", (e) => {
                            e.target.classList.remove("is-invalid");
                            e.target.nextElementSibling.nextElementSibling.innerText =
                                "";
                            e.target.parentElement.classList.remove(
                                "has-error"
                            );
                        });
                    }
                }
            }

            var response_error = error.responseJSON.errors;
            $.each(response_error, function (i, val) {
                $.each(val, function (j, val2) {
                    toastr.error(val2.replaceAll("-", " "));
                });
            });

            $("#submit-button").data("requestRunning", false);
            $("#submit-button").attr("disabled", false);
            $("#back-button").css("display", "");

            break;
    }
}

function isRequired(form, rule, error_msg) {
    if (form.value == "" || form.value == null) {
        let obj = {};
        if (rule) {
            Object.assign(obj, {
                field: form.field,
                message: `${form.label} field is required`,
            });
            error_msg.push(obj);
        }
    } else {
        removeErrorMessage(form.field);
    }
}

function minLength(form, rule, error_msg) {
    if (form.value != "" && form.value != null && form.value.length < rule) {
        let obj = {};
        Object.assign(obj, {
            field: form.field,
            message: `${form.label} minimal character is ${rule}`,
        });
        error_msg.push(obj);
    }
}

function maxLength(form, rule, error_msg) {
    if (form.value != "" && form.value != null && form.value.length > rule) {
        let obj = {};
        Object.assign(obj, {
            field: form.field,
            message: `${form.label} maximal character is ${rule}`,
        });
        error_msg.push(obj);
    }
}

function showButtons() {
    $("#back-button").css("display", "inline-flex");
    $("#submit-button").attr("disabled", false);
}

function showErrorMessages(errors) {
    if (errors.length > 0) {
        errors.filter((error) => {
            $(`#${error.field}-error`).text(error.message);
            $(`#${error.field}`).addClass("is-invalid");
            // toastr.error(error.message);
        });

        return true;
    }
    return false;
}

function removeErrorMessage(field) {
    $(`#${field}-error`).text("");
    $(`#${field}`).removeClass("is-invalid");
}

function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one("preXhr", function(e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one("preDraw", function(e, settings) {
            // Call the original action function
            if (button[0].className.indexOf("buttons-copy") >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(
                    self,
                    e,
                    dt,
                    button,
                    config
                );
            } else if (button[0].className.indexOf("buttons-excel") >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(
                        self,
                        e,
                        dt,
                        button,
                        config
                    ) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(
                        self,
                        e,
                        dt,
                        button,
                        config
                    );
            } else if (button[0].className.indexOf("buttons-csv") >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(
                        self,
                        e,
                        dt,
                        button,
                        config
                    ) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(
                        self,
                        e,
                        dt,
                        button,
                        config
                    );
            } else if (button[0].className.indexOf("buttons-pdf") >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(
                        self,
                        e,
                        dt,
                        button,
                        config
                    ) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(
                        self,
                        e,
                        dt,
                        button,
                        config
                    );
            } else if (button[0].className.indexOf("buttons-print") >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one("preXhr", function(e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}
