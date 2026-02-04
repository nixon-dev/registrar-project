$(document).ready(function () {
    const table = $("#documentTable");

    const ajaxUrl = table.data("url");
    const currentUsername = table.data("username");
    const csrfToken = table.data("csrf");

    $("#documentTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        info: false,
        paging: true, 

        language: {
            zeroRecords: "No Request Found",
        },

        pageLength: 25,
        order: [],
        responsive: true,

        columnDefs: [
            {
                orderable: false,
                targets: [4, 5, 6, 7],
            },
        ],

        columns: [
            {
                data: "cbt",
                name: "cbt",
                orderable: false,
                searchable: false,
                className: "text-center align-middle",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "student_id",
                name: "student_id",
            },
            {
                data: "fullname",
                name: "fullname",
                orderable: false,
                searchable: true,
            },
            {
                data: "request_type",
                name: "request_type",
                searchable: true,
            },
            {
                data: "username",
                name: "username",
                searchable: true,
            },
            {
                data: "status",
                name: "status",
                searchable: true,
            },
            {
                data: "view",
                name: "view",
                orderable: false,
                searchable: false,
                className: "text-center align-middle",
            },
        ],

        initComplete: function () {
            const api = this.api();

            api.columns([4, 5, 6]).every(function (index) {
                var column = this;

                var select = $(
                    '<select class="wp-100"><option value=""></option></select>'
                )
                    .appendTo($(column.header()).empty())
                    .on("change", function () {
                        column.search($(this).val()).draw();
                    });

                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d) {
                        select.append(
                            '<option value="' + d + '">' + d + "</option>"
                        );
                    });
                if (index === 5) {
                    if (
                        select.find("option[value='" + currentUsername + "']")
                            .length
                    ) {
                        select.val(currentUsername).trigger("change");
                    }
                }
            });
        },

        
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    });
});

$('#documentTable tbody').on('click', 'tr', function (e) {
    if ($(e.target).is('input, button, a, i')) return;
    if ($(e.target).closest('td').is(':last-child')) return;

    const checkbox = $(this).find('.row-checkbox');

    checkbox
        .prop('checked', !checkbox.prop('checked'))
        .trigger('change');

    $(this).toggleClass('selected', checkbox.prop('checked'));
});





$(document).on("change", ".row-checkbox", function () {
    if (!this.checked) {
        $("#select-all").prop("checked", false);
    }
});



const select = $("#bulk-status");
const bulkUrl = select.data("bulk-url");
const bulkCsrf = select.data("bulk-csrf");

$("#apply-bulk").on("click", function () {
    const status = $("#bulk-status").val();
    const ids = [];

    $(".row-checkbox:checked").each(function () {
        ids.push($(this).val());
    });

    if (!status || ids.length === 0) {
        Swal.fire({
            icon: "warning",
            title: "No selection",
            text: "Please select at least one record and an action.",
        });
        return;
    }

    Swal.fire({
        title: "Are you sure?",
        text: `Update ${ids.length} selected request(s)?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, update",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: bulkUrl,
                method: "POST",
                data: {
                    _token: bulkCsrf,
                    ids: ids,
                    status: status,
                },
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        $("#documentTable")
                            .DataTable()
                            .ajax.reload(null, false);

                        $("#select-all").prop("checked", false);
                        $("#bulk-status").val("");
                        $("#bulk-actions").addClass("d-none");
                        $("#apply-bulk").prop("disabled", true);
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again.",
                    });
                },
            });
        }
    });
});

function updateBulkUI() {
    const count = $(".row-checkbox:checked").length;

    if (count > 0) {
        $("#bulk-actions").removeClass("d-none");
    } else {
        $("#bulk-actions").addClass("d-none");
        $("#bulk-status").val("");
        $("#apply-bulk").prop("disabled", true);
    }
}

$("#documentTable").on("change", ".row-checkbox", function () {
    const row = $(this).closest("tr");
    row.toggleClass("selected", this.checked);
    updateBulkUI();
});


$("#documentTable").on("change", "#select-all", function () {
    $(".row-checkbox")
        .prop("checked", this.checked)
        .trigger("change");
        updateBulkUI();
});


$("#select-all").on("click", function () {
    $(".row-checkbox").prop("checked", this.checked);
});

$("#bulk-status").on("change", function () {
    $("#apply-bulk").prop("disabled", !this.value);

    $("#bulk-actions")
        .removeClass(function (i, cls) {
            return (cls.match(/status-\S+/g) || []).join(" ");
        })
        .addClass(`status-${this.value.toLowerCase().replace(/\s/g, "-")}`);
});
