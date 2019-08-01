$(document).ready(function(){
    $parent = $('#contentProperty');
    let contentProperty = {
        init: function () {
            this.dataTable();
            this.autoCloseAlert();
            this.deleteData();
        },
        dataTable: function() {
            $('#propertyTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/property/ajax',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                        d.type = $('select[name=type]').val();
                        d.is_co_living = ($('input[name=is_co_living]:checked').length > 0) ? 1 : 0;
                        d.is_entire_space = ($('input[name=is_entire_space]:checked').length > 0) ? 1 : 0;
                        d.land_area_type = $('select[name=land_area_type]').val();
                        d.arrangement = $('select[name=arrangement]').val();
                        d.floor_range = $('select[name=floor_range]').val();
                        d.is_pet_friendly = ($('input[name=is_pet_friendly]:checked').length > 0) ? 1 : 0;
                        d.status = $('select[name=status]').val();
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title'},
                    {data: 'type'},
                    {data: 'city'},
                    {data: 'province'},
                    {data: 'draft'},
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
            $('#propertyTable').on('click', '.deleteProperty[data-url]', function (e) { 
                e.preventDefault();
                let url = $(this).data('url');
                
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#propertyTable').DataTable().draw(false);
                    });
                }
            });
        }
    }
    if ($parent.length) {
        contentProperty.init();
    }
    $('#filterPropertyForm').on('submit', function(e) {
        $('#propertyTable').DataTable().draw(false);
        e.preventDefault();
    });

});
