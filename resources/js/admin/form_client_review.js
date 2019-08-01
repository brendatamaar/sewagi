$(document).ready(function(){
    $parent = $('#clientReviewForm');
    let clientReviewForm = {
        init: function () {
            this.autoCompleteLocation();
            this.validateForm();
            this.autoCloseAlert();
        },
        validateForm: function() {
            $("#clientReviewData").validate({
                rules: {
                    name: 'required',
                    message: 'required',
                    role: 'required',
                    picture: 'required'
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
        clientReviewForm.init();
    }
});
