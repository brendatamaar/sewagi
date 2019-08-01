$(document).ready(function(){
    $parent = $('#workingField');
    let workingField = {
        init: function () {
            this.dataTable();
            this.deleteData();
        },
        dataTable: function() {
            $('#workingFieldTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/working-field/ajax',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        },
        deleteData: function() {
            $('#workingFieldTable').on('click', '.deleteWorkingField[data-url]', function (e) { 
                e.preventDefault();
                let url = $(this).data('url');
                
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#workingFieldTable').DataTable().draw(false);
                    });
                }
            });
        }
    }
    if ($parent.length) {
        workingField.init();
    }
});
