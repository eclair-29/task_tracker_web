const bsAlert = $(".container").find(".alert"); // bootstrap alert

/**
 * Task Creation Modal: Populate user dropdown options.
 */
populateUsersDropdown("assigned_to");

/**
 * Task Creation Modal: Populate status dropdown options.
 */
populateStatusesDropdown("status");

/**
 * Task Creation Modal: Populate priorities dropdown options.
 */
populatePrioritiesDropdown("priority");

/**
 * Task Update Modal: Populate user, statuses and priorities dropdown options.
 */
$("body").on("click", ".edit-task-btn", function (e) {
    id = $(this).attr("id").replace("edit_task_btn_", "");
    populateUsersDropdown(`assigned_to_${id}`);
    populateStatusesDropdown(`status_${id}`);
    populatePrioritiesDropdown(`priority_${id}`);
});

/**
 * Task Creation Modal: Populate ticket id value on popup display.
 */
$("#create_task_btn").on("click", function () {
    populateTicketId("ticket_id");
});

/**
 * Create task.
 */
$("#create_task").on("submit", function (e) {
    e.preventDefault();

    const action = $(this).attr("action");

    const fields = {
        description: $("#description"),
        assigned_to: $("#assigned_to"),
        status: $("#status"),
        priority: $("#priority"),
    };

    clearErrorMessages(fields);
    clearBsAlert(bsAlert);

    const updateModal = bootstrap.Modal.getOrCreateInstance(
        `#${$(this).closest(".popup").attr("id")}`
    );

    createTask(
        action,
        $(this).serialize(),
        bsAlert,
        "create_task",
        fields,
        updateModal
    );
});

/**
 * Update task.
 */
$("body").on("submit", ".edit-task", function (e) {
    e.preventDefault();

    const id = $(this).attr("id").replace("edit_task_", "");
    const action = $(this).attr("action");

    const fields = {
        description: $(`#description_${id}`),
        assigned_to: $(`#assigned_to_${id}`),
        status: $(`#status_${id}`),
        priority: $(`#priority_${id}`),
    };

    clearErrorMessages(fields);
    clearBsAlert(bsAlert);

    const updateModal = bootstrap.Modal.getOrCreateInstance(
        `#${$(this).closest(".popup").attr("id")}`
    );

    updateTask(action, $(this).serialize(), bsAlert, fields, updateModal);
});

/**
 * Delete task.
 */
$("body").on("click", ".delete-task-btn", function (e) {
    const id = $(this).attr("id").replace("delete_task_btn_", "");

    const updateModal = bootstrap.Modal.getOrCreateInstance(
        `#${$(this).closest(".popup").attr("id")}`
    );

    clearBsAlert(bsAlert);
    deleteTask(id, bsAlert, updateModal);
});
