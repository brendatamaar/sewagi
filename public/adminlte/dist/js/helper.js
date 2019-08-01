var myHelper = {};
$(document).ready(function () {
    myHelper = {
        init: function () {
            this.initElement();
        },
        initElement: function () {
            $(document).tooltip({
                selector: '[data-toggle="tooltip"]'
            });
            if ($(".notif-alert").length) {
                var alertMessage = $(".notif-alert").val();
                var alertType = $(".notif-alert").data('type');
                myHelper.setAlert(alertMessage, alertType);
            }
        },
        deleteConfirm: function (message, functionCallback, url) {
            bootbox.confirm({
                message: message,
                buttons: {
                    confirm: {
                        label: 'Delete',
                        className: 'btn-danger'
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-default'
                    }
                },
                callback: function (result) {
                    if (result) {
                        functionCallback(url);
                    }
                }
            });
        },
        okConfirm: function (message, functionCallback, url) {
            bootbox.confirm({
                message: message,
                buttons: {
                    confirm: {
                        label: 'OK',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-default'
                    }
                },
                callback: function (result) {
                    if (result) {
                        functionCallback(url);
                    }
                }
            });
        },
        setAlert: function (message, type) {
            iziToast.settings({
                position: 'topRight',
                transitionIn: 'fadeInDown',
                transitionOut: 'flipOutX',
                balloon: true,
                timeout: 10000
            });
            switch (type) {
                case 'success':
                    iziToast.success({
                        title: 'OK',
                        message: message,
                    });
                    break;
                case 'warning':
                    iziToast.warning({
                        title: 'Warning',
                        message: message,
                    });
                    break;
                case 'danger':
                    iziToast.error({
                        title: 'Error',
                        message: message,
                    });
                    break;
                case 'info':
                    iziToast.info({
                        title: 'Info',
                        message: message,
                    });
                    break;
                default:
                    iziToast.show({
                        message: message,
                    });
                    break;
            }
        }

    };
    myHelper.init();
});