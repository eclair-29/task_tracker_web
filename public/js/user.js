/**
 * Initiate User tasks table.
 */
let userTasksTable = $("#user_tasks_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: `${BASE_URL}/tasks/user`,
    columns: getTasksTableData(),
    order: [[9, "desc"]], // order by updated_at desc
});

/**
 * Make User tasks table responsive.
 */
wrapDataTableToTableResponsive("user_tasks_table");
