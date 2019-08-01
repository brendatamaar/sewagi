$(document).ready(function(){
    $parent = $('#manageAdmin');
    let manageAdmin = {
        init: function () {
            this.dataTable();
            this.updateStatus();
        },
        dataTable: function() {
            $('#manageAdminTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/manage-admin/ajax',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'email'},
                    {data: 'calling_code'},
                    {data: 'phone_number'},
                    {data: 'gender'},
                    {data: 'is_active'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        },
        updateStatus: function() {
            $('#manageAdminTable').on('click', '.updateStatus[data-url]', function (e) { 
                e.preventDefault();
                let url = $(this).data('url');
                let status = $(this).data('status') ? 0 : 1;
                
                if (confirm('Are you sure you want to change account status?')) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        dataType: 'json',
                        data: {is_active: status}
                    }).always(function (data) {
                        $('#manageAdminTable').DataTable().draw(false);
                    });
                }
            });
        }
    }
    if ($parent.length) {
        manageAdmin.init();
    }
});
