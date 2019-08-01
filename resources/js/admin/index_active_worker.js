$(document).ready(function(){
    $parent = $('#activeWorkerTable');
    let activeWorkerTable = {
        table: {},
        init: function () {
            this.dataTable();
            this.eventHandle();
        },
        dataTable: function() {
            activeWorkerTable.table = $('#workerTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/active-worker/ajax',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'place_name'},
                    {data: 'province'},
                    {data: 'city'},
                    {data: 'district'},
                    {data: 'postcode'},
                    {data: 'latitude'},
                    {data: 'longitude'},
                    {data: 'action', orderable: false, searchable: false}
                ],
                "columnDefs": [
                    {targets: 'text-right', className: 'text-right'},
                ],
            });
        },
        eventHandle: function (params) {
            $('#workerTable').on('click', '.deleteWorker[data-url]', function (e) {
                e.preventDefault();
                let url = $(this).data('url');
                return myHelper.deleteConfirm('Are you sure you want to delete this?', activeWorkerTable.deleteData, url);
            });
        },
        deleteData: function(url) {
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
                activeWorkerTable.table.draw(false);
            });
        }
    }
    if ($parent.length) {
        activeWorkerTable.init();
    }
});
