$(document).ready(function(){
    $parent = $('#contentClientReview');
    let contentClientReview = {
        init: function () {
            this.dataTable();
            this.autoCloseAlert();
            this.deleteData();
        },
        dataTable: function() {
            $('#clientReviewTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/client-review/ajax',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name'},
                    {data: 'role'},
                    {data: 'message'},
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
            $('#clientReviewTable').on('click', '.deleteReview[data-url]', function (e) { 
                e.preventDefault();
                let url = $(this).data('url');
                
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#clientReviewTable').DataTable().draw(false);
                    });
                }
            });
        }
    }
    if ($parent.length) {
        contentClientReview.init();
    }
});