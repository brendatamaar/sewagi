$(document).ready(function(){
    $parent = $('#contentCategoryTable');
    let contentCategoryTable = {
        init: function () {
            this.dataTable();
            this.autoCloseAlert();
            this.deleteData();
        },
        dataTable: function() {
            $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/configuration/ajax',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'category_name'},
                    {data: 'name'},
                    {data: 'value'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        },
        autoCloseAlert: function() {
            setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3000);
        },
        deleteData: function() {
            $('#categoryTable').on('click', '.deleteConfig[data-url]', function (e) { 
                e.preventDefault();
                let url = $(this).data('url');
                
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#categoryTable').DataTable().draw(false);
                    });
                }
            });
        }
    }
    if ($parent.length) {
        contentCategoryTable.init();
    }
});
