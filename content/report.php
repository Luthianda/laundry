<?php
$selectOrder = mysqli_query($config, "SELECT order_date FROM trans_orders ORDER BY order_date");
$rowOrder = mysqli_fetch_all($selectOrder, MYSQLI_ASSOC);
$len = mysqli_num_rows($selectOrder);

if ($len > 0) {
    $date_min = $rowOrder[0]['order_date'];
    $date_max = $rowOrder[$len - 1]['order_date'];
} else {
    $date_min = '';
    $date_max = '';
}

if (isset($_POST['filter'])) {
    $start = $_POST['date_start'];
    $end = $_POST['date_end'];
} else {
    $start = $date_min;
    $end = $date_max;
}

$queryReport = mysqli_query($config, "SELECT c.customer_name, o.order_date, s.service_name, od.qty, s.price, od.subtotal FROM trans_order_details AS od LEFT JOIN type_of_services AS s ON od.id_service = s.id LEFT JOIN trans_orders o ON od.id_order = o.id LEFT JOIN customers AS c ON o.id_customer = c.id WHERE o.order_date BETWEEN '$start' AND '$end' ORDER BY od.id, o.total DESC");
$rowReports = mysqli_fetch_all($queryReport, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Report Transaction Order</h5>
                <div class="table-responsive">
                    <div class="mb-3">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date Start</label>
                                    <input type="date" name="date_start" class="form-control"
                                        value="<?php echo $start; ?>" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date End</label>
                                    <input type="date" name="date_end" class="form-control" value="<?php echo $end; ?>"
                                        required>
                                </div>
                                <div class="col-sm-3 mt-8">
                                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-datatable pt-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Service</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rowReports as $rowReport): ?>
                                    <tr>
                                        <td><?php echo $rowReport['customer_name']; ?></td>
                                        <td><?php echo tanggal($rowReport['order_date']); ?></td>
                                        <td><?php echo $rowReport['service_name']; ?></td>
                                        <td><?php echo formatKg($rowReport['qty'] / 1000); ?></td>
                                        <td><?php echo rupiah($rowReport['price']); ?></td>
                                        <td><?php echo rupiah($rowReport['subtotal']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        'use strict';

        var dt_basic_table = $('.datatables-basic');

        // DataTable with buttons
        // --------------------------------------------------------------------

        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({
                ajax: assetsPath + '/json/table-datatable.json',
                columns: [
                    { data: '' },
                    { data: 'id' },
                    { data: 'id' },
                    { data: 'full_name' },
                    { data: 'email' },
                    { data: 'start_date' },
                    { data: 'salary' },
                    { data: 'status' },
                    { data: '' }
                ],
                columnDefs: [
                    {
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        responsivePriority: 2,
                        searchable: false,
                        targets: 0,
                        render: function (data, type, full, meta) {
                            return '';
                        }
                    },
                    {
                        // For Checkboxes
                        targets: 1,
                        orderable: false,
                        responsivePriority: 3,
                        searchable: false,
                        checkboxes: true,
                        render: function () {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                        },
                        checkboxes: {
                            selectAllRender: '<input type="checkbox" class="form-check-input">'
                        }
                    },
                    {
                        targets: 2,
                        searchable: false,
                        visible: false
                    },
                    {
                        // Avatar image/badge, Name and post
                        targets: 3,
                        responsivePriority: 4,
                        render: function (data, type, full, meta) {
                            var $user_img = full['avatar'],
                                $name = full['full_name'],
                                $post = full['post'];
                            if ($user_img) {
                                // For Avatar image
                                var $output =
                                    '<img src="' + assetsPath + '/img/avatars/' + $user_img + '" alt="Avatar" class="rounded-circle">';
                            } else {
                                // For Avatar badge
                                var stateNum = Math.floor(Math.random() * 6);
                                var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                var $state = states[stateNum],
                                    $name = full['full_name'],
                                    $initials = $name.match(/\b\w/g) || [];
                                $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                            }
                            // Creates full output for row
                            var $row_output =
                                '<div class="d-flex justify-content-start align-items-center">' +
                                '<div class="avatar-wrapper">' +
                                '<div class="avatar me-2">' +
                                $output +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex flex-column">' +
                                '<span class="emp_name text-truncate">' +
                                $name +
                                '</span>' +
                                '<small class="emp_post text-truncate text-body-secondary">' +
                                $post +
                                '</small>' +
                                '</div>' +
                                '</div>';
                            return $row_output;
                        }
                    },
                    {
                        responsivePriority: 1,
                        targets: 4
                    },
                    {
                        // Label
                        targets: -2,
                        render: function (data, type, full, meta) {
                            var $status_number = full['status'];
                            var $status = {
                                1: { title: 'Current', class: 'bg-label-primary' },
                                2: { title: 'Professional', class: ' bg-label-success' },
                                3: { title: 'Rejected', class: ' bg-label-danger' },
                                4: { title: 'Resigned', class: ' bg-label-warning' },
                                5: { title: 'Applied', class: ' bg-label-info' }
                            };
                            if (typeof $status[$status_number] === 'undefined') {
                                return data;
                            }
                            return (
                                '<span class="badge rounded-pill ' +
                                $status[$status_number].class +
                                '">' +
                                $status[$status_number].title +
                                '</span>'
                            );
                        }
                    },
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, full, meta) {
                            return (
                                '<div class="d-inline-block">' +
                                '<a href="javascript:;" class="btn btn-sm text-primary btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base ti tabler-dots-vertical-rounded"></i></a>' +
                                '<ul class="dropdown-menu dropdown-menu-end">' +
                                '<li><a href="javascript:;" class="dropdown-item">Details</a></li>' +
                                '<li><a href="javascript:;" class="dropdown-item">Archive</a></li>' +
                                '<div class="dropdown-divider"></div>' +
                                '<li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '<a href="javascript:;" class="btn btn-sm text-primary btn-icon item-edit"><i class="icon-base ti tabler-pencil"></i></a>'
                            );
                        }
                    }
                ],
                order: [[2, 'desc']],
                dom:
                    '<"card-header"<"head-label text-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [
                    {
                        extend: 'collection',
                        className: 'btn btn-label-primary dropdown-toggle me-2',
                        text: '<i class="icon-base ti tabler-show me-1"></i>Export',
                        buttons: [
                            {
                                extend: 'print',
                                text: '<i class="icon-base ti tabler-printer me-1" ></i>Print',
                                className: 'dropdown-item',
                                exportOptions: { columns: [3, 4, 5, 6, 7] }
                            },
                            {
                                extend: 'csv',
                                text: '<i class="icon-base ti tabler-file me-1" ></i>Csv',
                                className: 'dropdown-item',
                                exportOptions: { columns: [3, 4, 5, 6, 7] }
                            },
                            {
                                extend: 'excel',
                                text: 'Excel',
                                className: 'dropdown-item',
                                exportOptions: { columns: [3, 4, 5, 6, 7] }
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="icon-base ti tabler-file-text me-1"></i>Pdf',
                                className: 'dropdown-item',
                                exportOptions: { columns: [3, 4, 5, 6, 7] }
                            },
                            {
                                extend: 'copy',
                                text: '<i class="icon-base ti tabler-copy me-1" ></i>Copy',
                                className: 'dropdown-item',
                                exportOptions: { columns: [3, 4, 5, 6, 7] }
                            }
                        ]
                    },
                    {
                        text: '<i class="icon-base ti tabler-plus me-1"></i> <span class="d-none d-lg-inline-block">Add New Record</span>',
                        className: 'create-new btn btn-primary'
                    }
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details of ' + data['full_name'];
                            }
                        }),
                        type: 'column',
                        renderer: function (api, rowIdx, columns) {
                            var data = $.map(columns, function (col, i) {
                                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ? '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>'
                                    : '';
                            }).join('');

                            return data ? $('<table class="table"/><tbody />').append(data) : false;
                        }
                    }
                }
            });
            $('div.head-label').html('<h5 class="card-title mb-0">DataTable with Buttons</h5>');
        }
    });
</script>