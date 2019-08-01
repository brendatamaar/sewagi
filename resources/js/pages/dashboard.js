const DASHBOARD = {
    sidebar: {
        init () {
            /**
             * Sidebar nav-main
             *
             */
            const SCOPE_SELECTOR = '#sidebar .nav-main'

            if (!$(SCOPE_SELECTOR).length) return

            $(document).on('sb:slidedown', SCOPE_SELECTOR + ' .nav-item:not(:disabled,.disabled,.is-opened)', function (e) {
                const $self = $(this)

                if (!$self.find('.navbar-nav .nav-item').length) return

                const $child = $self.addClass('is-opening').find('> .navbar-nav')

                $child.slideDown({
                    duration: 275,
                    queue: false,
                    easing: 'easeInOutSine',
                    always () {
                        $self.addClass('is-opened')
                        $self.removeClass('is-opening')
                        $child.css('display', '')
                    }
                })
            })

            $(document).on('sb:slideup', SCOPE_SELECTOR + ' .nav-item:not(:disabled,.disabled)', function (e) {
                const $self = $(this)

                if (!$self.find('.navbar-nav .nav-item').length) return

                const $child = $self.addClass('is-opening').find('> .navbar-nav')

                $child.slideUp({
                    duration: 225,
                    easing: 'easeOutSine',
                    always () {
                        $self.removeClass('is-opened is-opening')
                        $child.css('display', '')
                    }
                })
            })

            $(document).on('click.sidebar', SCOPE_SELECTOR + ' .nav-item:not(:disabled,.disabled,.is-opening) > .nav-link', $.debounce(function (e) {
                e.preventDefault()

                const $self = $(this).closest('.nav-item')

                if ($self.hasClass('is-opened')) {
                    $self.trigger('sb:slideup')
                } else {
                    $('.is-opened', SCOPE_SELECTOR).trigger('sb:slideup')
                    $(this).trigger('sb:slidedown')
                }
            }, 250))

            // This intent is to make developer write less classes on html side.
            // So we added dynamically here.
            $('.nav-item > .navbar-nav', SCOPE_SELECTOR).addClass('navbar-nav-child')

            // Now, open the `nav-item` which is currently active on first page load
            $('.nav-item.active', SCOPE_SELECTOR).trigger('sb:slidedown')

            /**
             * Sidebar nav-profile
             *
             */
            const navProfileContent = $('#templatePopoverNavProfileMenu').html()
            $('#templatePopoverNavProfileMenu').remove()

            function initPopover () {
                $('.nav-profile > .nav-item > .nav-link').popover({
                    placement: 'right',
                    html: true,
                    boundary: 'viewport',
                    content: navProfileContent,
                    trigger: 'manual',
                    template: '<div class="popover popover-nav-profile"><div class="arrow"></div><div class="popover-body"></div></div>'
                }).on('click.popover', function () {
                    $(this).popover('show')
                })
            }

            initPopover()

            $(document).on('shown.bs.popover', '.nav-profile > .nav-item > .nav-link', function () {
                const $scope = $(this)

                $('body').on('click.navprofile', function (e) {
                    const $self = $(e.target)

                    if (!($self.is('.nav-profile-menu') || $self.closest('.nav-profile-menu').length)) {
                        $scope.popover('hide')
                    }
                })
            })

            $(document).on('hide.bs.popover hidden.bs.popover', '.nav-profile > .nav-item > .nav-link', function () {
                $('body').off('click.navprofile')
                $('.nav-profile > .nav-item > .nav-link').popover('dispose').off('click.popover')
                setTimeout(function () {
                    initPopover()
                }, 300)
            })
        }
    }
}

$(() => {
    DASHBOARD.sidebar.init()
})
