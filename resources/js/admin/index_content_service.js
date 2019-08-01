$(document).ready(function(){
    $parent = $('#contentServiceTable');
    let contentServiceTable = {
        table: {},
        init: function () {
            this.dataTable();
            this.eventHandle();
        },
        dataTable: function () {
            contentServiceTable.table = $('#serviceTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/content-service/ajax',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'id_name'},
                    {data: 'en_name'},
                    {data: 'id_description'},
                    {data: 'en_description'},
                    {data: 'action', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    {targets: 'text-right', className: 'text-right'}
                ],
            });
        },
        eventHandle: function (params) {
            $('#serviceTable').on('click', '.deleteService[data-url]', function (e) {
                e.preventDefault();
                let url = $(this).data('url');
                return myHelper.deleteConfirm('Are you sure you want to delete this?', contentServiceTable.deleteData, url);
            });
        },
        deleteData: function (url) {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data: {
                    method: '_DELETE',
                    submit: true
                }
            }).always(function (data) {
                myHelper.setAlert(data.message, 'success');
                contentServiceTable.table.draw(false);
            });
        }
    }
    if ($parent.length) {
        contentServiceTable.init();
    }
});
