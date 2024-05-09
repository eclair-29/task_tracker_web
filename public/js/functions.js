/**
 * Get tasks table data/fields
 */

function getTasksTableData() {
    const taskTableDataCols = [
        {
            data: "id",
            render: (data, type, row) => `
                <a 
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_task_popup_${data}"
                    id="edit_task_btn_${data}"
                    class="link-info fw-bold edit-task-btn"
                >
                    Edit
                </a>
                <a 
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_task_popup_${data}"
                    class="link-danger fw-bold"
                >
                    Delete
                </a>
            `,
        },
        {
            data: "ticket_id",
            render: (data, type, row) => `
                <span class="fw-bold text-dark">${data}</span>
            `,
        },
        { data: "description" },
        {
            data: "status",
            render: (data, type, row) => {
                switch (data) {
                    case "Pending":
                        return `<span class="fw-bold text-warning">${data}</span>`;
                    case "In progress":
                        return `<span class="fw-bold text-info">${data}</span>`;
                    default:
                        return `<span class="fw-bold text-success">${data}</span>`;
                }
            },
        },
        {
            data: "priority",
            render: (data, type, row) => {
                switch (data) {
                    case "Low":
                        return `<span class="fw-bold text-info">${data}</span>`;
                    case "Medium":
                        return `<span class="fw-bold text-warning">${data}</span>`;
                    default:
                        return `<span class="fw-bold text-danger">${data}</span>`;
                }
            },
        },
        { data: "assigned_to" },
        { data: "created_by" },
        { data: "created_at" },
        { data: "updated_by" },
        { data: "updated_at" },
    ];

    return taskTableDataCols;
}

/**
 * Get users table data/fields
 */

function getUsersTableData() {
    const usersTableDataCols = [
        {
            data: "id",
            render: (data, type, row) => `
                <a 
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#edit_user_popup_${data}"
                    id="edit_user_btn_${data}"
                    class="link-info fw-bold edit-user-btn"
                >
                    Edit
                </a>
                <a 
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#delete_user_popup_${data}"
                    class="link-danger fw-bold disabled"
                >
                    Delete
                </a>
            `,
        },
        {
            data: "name",
            render: (data, type, row) => `
                <span class="fw-bold text-dark">${data}</span>
            `,
        },
        { data: "username" },
        { data: "email" },
        {
            data: "status",
            render: (data, type, row) => {
                switch (data) {
                    case "Active":
                        return `<span class="fw-bold text-success">${data}</span>`;
                    default:
                        return `<span class="fw-bold text-danger">${data}</span>`;
                }
            },
        },
        { data: "created_at" },
    ];

    return usersTableDataCols;
}

/**
 * Overrides datatables responsive behaviour.
 */
function wrapDataTableToTableResponsive(tableId) {
    $(`#${tableId}`).wrap("<div class='table-responsive'></div>");
}

/**
 * Ajax call for populating users dropdown.
 */
function populateUsersDropdown(selectId) {
    $(`#${selectId}`).children("option:not(:selected)").remove();

    $.ajax({
        type: "get",
        url: `${BASE_URL}/backoffice/users`,
        success: function (data) {
            $.each(data, function (key, value) {
                $(`#${selectId}`).append(
                    `<option value="${value.id}">${value.name}</option>`
                );
            });
        },
    });
}

/**
 * Ajax call for populating task statuses dropdown.
 */
function populateStatusesDropdown(selectId) {
    $(`#${selectId}`).children("option:not(:selected)").remove();

    $.ajax({
        type: "get",
        url: `${BASE_URL}/tasks/statuses`,
        success: function (data) {
            $.each(data, function (key, value) {
                $(`#${selectId}`).append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.description +
                        "</option>"
                );
            });
        },
    });
}

/**
 * Ajax call for populating priorities dropdown.
 */
function populatePrioritiesDropdown(selectId) {
    $(`#${selectId}`).children("option:not(:selected)").remove();

    $.ajax({
        type: "get",
        url: `${BASE_URL}/tasks/priorities`,
        success: function (data) {
            $.each(data, function (key, value) {
                $(`#${selectId}`).append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.description +
                        "</option>"
                );
            });
        },
    });
}

/**
 * Ajax call for populating user statuses dropdown.
 */
function populateUserStatusesDropdown(selectId) {
    $(`#${selectId}`).children("option:not(:selected)").remove();

    $.ajax({
        type: "get",
        url: `${BASE_URL}/backoffice/utilities/users/statuses`,
        success: function (data) {
            $.each(data, function (key, value) {
                $(`#${selectId}`).append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.description +
                        "</option>"
                );
            });
        },
    });
}

/**
 * Ajax call for getting auto generated ticket id.
 */
function populateTicketId(inputId) {
    $.ajax({
        type: "get",
        url: `${BASE_URL}/tasks/ticket`, // call this route to correctly checked ticket id count pre/post task creation
        success: function (data) {
            $(`#${inputId}`).val(data);
        },
    });
}

/**
 * Ajax call for getting fresh tasks records and re-drawing table.
 */
function redrawTasksTable(tableId) {
    $.ajax({
        type: "get",
        url: `${BASE_URL}/tasks`,
        success: function (response) {
            tableId.clear();
            tableId.rows.add(response.data).draw();
        },
        error: function (error) {
            console.log(error);
        },
    });
}

/**
 * Ajax call for getting fresh users records and re-drawing table.
 */
function redrawUsersTable(tableId) {
    $.ajax({
        type: "get",
        url: `${BASE_URL}/backoffice/utilities/users`,
        success: function (response) {
            tableId.clear();
            tableId.rows.add(response.data).draw();
        },
        error: function (error) {
            console.log(error);
        },
    });
}

/**
 * Control BS alert appearance.
 */
function clearBsAlert(bsAlert) {
    bsAlert.attr("hidden", true);
    bsAlert.attr("class", "alert").text("");
}

/**
 * Clear Error Messages.
 */
function clearErrorMessages(fields) {
    Object.values(fields).forEach((field) => {
        field.attr("class", field.attr("class").replace(" is-invalid", ""));

        const invalidFeedback = field
            .closest('[class*="col"]')
            .find(".invalid-feedback");

        const hasFeedback = invalidFeedback.length > 0;

        hasFeedback && invalidFeedback.remove();
    });
}

/**
 * Associate task error validation responses to fields.
 */
function getTaskErrorMessage(errors, fields) {
    const getMessage = (errors, field) =>
        errors.forEach((error) => {
            field.addClass("is-invalid");
            field
                .closest('[class*="col"]')
                .append(
                    '<span class="invalid-feedback fw-bold d-block">' +
                        error +
                        "</span>"
                );
        });

    const { description, assigned_to, status, priority } = errors;

    if (description) getMessage(description, fields.description);
    if (assigned_to) getMessage(assigned_to, fields.assigned_to);
    if (status) getMessage(status, fields.status);
    if (priority) getMessage(priority, fields.priority);
}

/**
 * Associate user error validation responses to fields.
 */
function getUserErrorMessage(errors, fields) {
    const getMessage = (errors, field) =>
        errors.forEach((error) => {
            field.addClass("is-invalid");
            field
                .closest('[class*="col"]')
                .append(
                    '<span class="invalid-feedback fw-bold d-block">' +
                        error +
                        "</span>"
                );
        });

    const { name, email, user_status, username, password } = errors;

    if (name) getMessage(name, fields.name);
    if (email) getMessage(email, fields.email);
    if (user_status) getMessage(user_status, fields.user_status);
    if (username) getMessage(username, fields.username);
    if (password) getMessage(password, fields.password);
}

/**
 * Create Task - Post Request.
 */
function createTask(action, data, bsAlert, postId, fields, popup) {
    $.ajax({
        url: action,
        type: "post",
        data,
        success: function (data) {
            bsAlert.attr("hidden", false);

            if (data.response === "success")
                bsAlert.attr("class", "alert alert-success").text(data.alert);
            else bsAlert.attr("class", "alert alert-danger").text(data.alert);

            const datatable = data.roles.includes("user")
                ? userTasksTable
                : backofficeTasksTable;

            redrawTasksTable(datatable); // re-draw tasks datatable after task creation

            popup.toggle();
            $(`#${postId}`).trigger("reset");
        },
        error: function (error) {
            // associate error validation responses to fields
            const errors = error.responseJSON.errors;
            getTaskErrorMessage(errors, fields);
        },
    });
}

/**
 * Update Task - Put Request.
 */
function updateTask(action, data, bsAlert, fields, popup) {
    $.ajax({
        url: action,
        type: "put",
        data,
        success: function (data) {
            bsAlert.attr("hidden", false);

            if (data.response === "success")
                bsAlert.attr("class", "alert alert-success").text(data.alert);
            else bsAlert.attr("class", "alert alert-danger").text(data.alert);

            const datatable = data.roles.includes("user")
                ? userTasksTable
                : backofficeTasksTable;

            redrawTasksTable(datatable); // re-draw tasks datatable after task creation

            popup.toggle();
        },
        error: function (error) {
            // associate error validation responses to fields
            const errors = error.responseJSON.errors;
            getTaskErrorMessage(errors, fields);
        },
    });
}

/**
 * Delete Task - Delete Request.
 */
function deleteTask(id, bsAlert, popup) {
    $.ajax({
        type: "delete",
        url: `${BASE_URL}/tasks/${id}`,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            bsAlert.attr("hidden", false);

            if (data.response === "success")
                bsAlert.attr("class", "alert alert-success").text(data.alert);
            else bsAlert.attr("class", "alert alert-danger").text(data.alert);

            const datatable = data.roles.includes("user")
                ? userTasksTable
                : backofficeTasksTable;

            redrawTasksTable(datatable); // re-draw tasks datatable after task creation

            popup.toggle();
        },
    });
}

/**
 * Add User - Post Request.
 */
function addUser(action, data, bsAlert, postId, fields, popup) {
    $.ajax({
        url: action,
        type: "post",
        data,
        success: function (data) {
            bsAlert.attr("hidden", false);

            if (data.response === "success")
                bsAlert.attr("class", "alert alert-success").text(data.alert);
            else bsAlert.attr("class", "alert alert-danger").text(data.alert);

            redrawUsersTable(backofficeUsersTable); // re-draw users datatable after task creation

            popup.toggle();
            $(`#${postId}`).trigger("reset");
        },
        error: function (error) {
            // associate error validation responses to fields
            const errors = error.responseJSON.errors;
            getUserErrorMessage(errors, fields);
        },
    });
}
