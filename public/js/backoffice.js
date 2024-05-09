/**
 * Initiate Backoffice tasks table.
 */
let backofficeTasksTable = $("#backoffice_tasks_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${BASE_URL}/tasks`,
    columns: getTasksTableData(),
    order: [[9, "desc"]], // order by updated_at desc
});

/**
 * Initiate Backoffice users table.
 */
let backofficeUsersTable = $("#backoffice_users_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${BASE_URL}/backoffice/utilities/users`,
    columns: getUsersTableData(),
    order: [[5, "desc"]], // order by created_at desc
});

/**
 * Re-draw backoffice tasks table.
 */
// redrawTasksTable(backofficeTasksTable);

/**
 * Make Backoffice tasks table responsive.
 */
wrapDataTableToTableResponsive("backoffice_tasks_table");

/**
 * User Creation Modal: Populate user statuses dropdown options.
 */
populateUserStatusesDropdown("user_status");

/**
 * Add user.
 */
$("#create_user").on("submit", function (e) {
    e.preventDefault();

    const action = $(this).attr("action");

    const fields = {
        name: $("#name"),
        email: $("#email"),
        username: $("#username"),
        password: $("#password"),
        user_status: $("#user_status"),
    };

    clearErrorMessages(fields);
    clearBsAlert(bsAlert);

    const updateModal = bootstrap.Modal.getOrCreateInstance(
        `#${$(this).closest(".popup").attr("id")}`
    );

    addUser(
        action,
        $(this).serialize(),
        bsAlert,
        "create_user",
        fields,
        updateModal
    );
});
