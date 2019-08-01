$(document).ready(function(){
    $parent = $('#configCategoryForm');
    let configCategoryForm = {
        init: function () {
            this.validateForm();
            this.autoCloseAlert();
        },
        validateForm: function() {
            $("#configCategoryData").validate({
                rules: {
                    name: 'required',
                },
                errorElement: 'em',
                errorPlacement: function(error, element) {
                    error.addClass("help-block");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
                }
            });
        },
        autoCloseAlert: function() {
            setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 3000);
        },
    }
    if ($parent.length) {
        configCategoryForm.init();
    }
});
