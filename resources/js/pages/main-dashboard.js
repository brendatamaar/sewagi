$(document).ready(function () {
    $parent = $("#mainDashboard");
    const dashboard = {
        init: function () {
            this.initialize();
            this.favouritesProperties();
            this.nearmeProperties();
            this.recentViewProperties();
            this.recentSearchedProperties();
            this.mostAvailableProperties();
            this.mostSearchedProperties();
        },
        state: {
            user: {},
            options: [],
            reply_tour: {
                is_property_available: 1,
                confirmed_tour_id: null,
                property_available_at: null,
                is_property_indefinitely: null
            }
        },
        initialize: function() {
            const user = JSON.parse($('#user').val());
            const options = JSON.parse($('#scheduleOptions').val());
            this.state.user = user;
            this.state.options = options;

            let nextDay = new Date();
            nextDay.setDate(nextDay.getDate() + 1);
            $('.date-time-picker').datetimepicker('minDate', nextDay);

            $('.datetimepicker-input').each(function() {
                if ($(this).data('filled') === 0) {
                    $(this).val('')
                }
            });

            $(document).on('click', '.card-tag', function () {
                if (!$(this).hasClass('card-tag-outline')) {
                    return;
                }

                let state = $(this).data('active');
                let type = $(this).data('type');
                let id = $(this).data('id');
                let price = dashboard.formatPrice($(this).data('price'));
                let img = $(this).data('img');
                let room = $(this).data('room');

                if (type === 'coliving') {
                    $(`#tag-left-${id}`).data('active', 0).removeClass('card-tag-outline');
                    $(`#tag-right-${id}`).data('active', 1).addClass('card-tag-outline');
                    $(`#price-${id}`).text(`${price} / Room / Month`);
                    $(`#icon-${id}`).attr('src', img);
                    $(`#room-${id}`).text(room);
                } else {
                    $(`#tag-left-${id}`).data('active', 1).addClass('card-tag-outline');
                    $(`#tag-right-${id}`).data('active', 0).removeClass('card-tag-outline');
                    $(`#price-${id}`).text(`${price} / Month`);
                    $(`#icon-${id}`).attr('src', img);
                    $(`#room-${id}`).text(room);
                }
            });

            $(document).on('click', '.add-favorite', function () {
                let token = document.head.querySelector('meta[name="csrf-token"]');
                let liked = $(this).hasClass('like-active');
                let pid = $(this).data('id');
                $('#favourites-property').empty();

                if (liked) {
                    fetch(`/property-favorite/${pid}`, {
                        method: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': token.content
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            $(this).removeClass('like-active');
                            dashboard.favouritesProperties();
                        })
                        .catch(error => console.log(error));
                } else {
                    fetch('/property-favorite', {
                        method: 'post',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': token.content
                        },
                        body: JSON.stringify({ property_id: pid })
                    })
                        .then(response => response.json())
                        .then(data => {
                            $(this).addClass('like-active');
                            dashboard.favouritesProperties();
                        })
                        .catch(error => console.log(error));
                }
            });

            $('.delete-date').click(function() {
                $(this).parent().prev().val('');
            });

            $('#btn-reschedule-date').click(function() {
                $('#modalEditVisitDate').modal('show');
            });

            $('#reschedule-time').click(function() {
                const id = $('#scheduleId').val();

                const options = [0,1,2,3,4,5].map(id => {
                    if ($(`#time-${id}`).val() !== '') {
                        return $(`#time-${id}`).val();
                    }
                }).filter(q => q !== undefined);

                fetch('/dashboard/update-schedule-time', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ schedule_id: id, options })
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#modalEditVisitDate').modal('hide');
                        location.reload();
                    })
                    .catch(error => console.log(error));
            });

            $('#btn-reply-request').click(function() {
                $('#modalPropertyTourRequest').modal('show');
                $('#property-status-switch').prop('checked', true);
                $('#property-status-switch').parent().next().text('Available');
                $('#property-available').slideDown();
                $('#property-unavailable').slideUp();
                $('input[name="pick-time"]').prop('checked', false);
                $('#btn-confirm-request').addClass('disabled');
                $('#btn-confirm-request').text('Submit');
            });

            let reply = this.state.reply_tour;
            $('#property-status-switch').change(function() {
                $('#btn-confirm-request').addClass('disabled');
                if ($(this).prop('checked')) {
                    reply.is_property_available = 1;
                    reply.is_property_indefinitely = null;
                    reply.property_available_at = null;
                    $(this).parent().next().text('Available');
                    $('#property-available').slideDown();
                    $('#property-unavailable').slideUp();
                    $('#btn-confirm-request').text('Submit');
                } else {
                    reply.is_property_available = 0;
                    reply.confirmed_tour_id = null;
                    $(this).parent().next().text('Not Available');
                    $('#property-available').slideUp();
                    $('#property-unavailable').slideDown();
                    $('input[name="pick-time"]').prop('checked', false);
                    $('#btn-confirm-request').text('Reply');
                    $('#unavailable-date').val('');
                    $('#indefinitely-date').prop('checked', false);
                    $('#unavailable-date').attr('disabled', false);
                }
            });

            $('input[name="pick-time"]').change(function() {
                const id = $(this).data('id');
                if ($(this).prop('checked')) {
                    reply.confirmed_tour_id = id || null;
                    $('#btn-confirm-request').removeClass('disabled');
                } else {
                    reply.confirmed_tour_id = null;
                    $('#btn-confirm-request').addClass('disabled');
                }
            });

            $('#indefinitely-date').change(function() {
                if ($(this).prop('checked')) {
                    reply.is_property_indefinitely = 1;
                    $('#unavailable-date').attr('disabled', true);
                    $('#unavailable-date').val('');
                    $('#btn-confirm-request').removeClass('disabled');
                } else {
                    reply.is_property_indefinitely = null;
                    $('#unavailable-date').attr('disabled', false);
                    $('#btn-confirm-request').addClass('disabled');
                }
            });

            $('#date-picker').on('change.datetimepicker', function(e){
                if ($('#unavailable-date').val() !== '') {
                    reply.property_available_at = $('#unavailable-date').val();
                    $('#btn-confirm-request').removeClass('disabled');
                } else {
                    reply.property_available_at = null;
                    $('#btn-confirm-request').addClass('disabled');
                }
            });

            $('#btn-confirm-request').click(function() {
                const id = $('#scheduleId').val();
                fetch(`/dashboard/reply-tour/${id}`, {
                    method: 'put',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(dashboard.state.reply_tour)
                })
                    .then(response => response.json())
                    .then(data => {
                        $('#modalPropertyTourRequest').modal('show');
                        location.reload();
                    })
                    .catch(error => console.log(error));
            });
        },
        favouritesProperties: function() {
            fetch('/dashboard/favourites-property')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return dashboard.renderData(data, 'favourites-property', 'fav');
                    }

                    $('#section-favourites').hide();
                })
                .catch(error => console.log(error));
        },
        recentViewProperties: function() {
            fetch('/dashboard/recent-view-property?limit=2')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return dashboard.renderData(data, 'recent-view-property', 'rv');
                    }

                    $('#section-recent-view').hide();
                })
                .catch(error => console.log(error));
        },
        recentSearchedProperties: function() {
            fetch('/dashboard/recent-searched-property')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return dashboard.renderData(data, 'recent-searched-property', 'rs');
                    }

                    $('#section-recent-searched').hide();
                })
                .catch(error => console.log(error));
        },
        nearmeProperties: function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    fetch('/dashboard/nearme-property', {
                        method: 'post',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(pos)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                return dashboard.renderData(data, 'nearme-property', 'nm');
                            }

                            $('#section-nearme').hide();
                        })
                        .catch(error => console.log(error));
                })
            } else {
                console.log('Drowser not supported');
            }
        },
        mostSearchedProperties: function() {
            fetch('/dashboard/most-searched-property')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return dashboard.renderData(data, 'most-searched-property', 'ms');
                    }

                    $('#section-most-searched').hide();
                })
                .catch(error => console.log(error));
        },
        mostAvailableProperties: function() {
            fetch('/dashboard/most-available-property')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return dashboard.renderData(data, 'most-available-property', 'ma');
                    }

                    $('#section-most-available').hide();
                })
                .catch(error => console.log(error));
        },
        formatPrice: function (price) {
            return accounting.formatMoney(price, 'IDR ', 0, ',');
        },
        renderData: function (data, element, id) {
            let resultList = document.getElementById(element);

            data.forEach((q, i) => {
                const newId = `${id}-${i}`;
                const tmpl = dashboard.renderCard(q, newId);
                resultList.appendChild(tmpl);
            });
        },
        renderCard: function (q, i) {
            let tmpl = document.getElementById('result-item').content.cloneNode(true);
            const url = `/property/${q.id}/${q.slug_url}`;

            tmpl.querySelector('.card-property').id = q.id;
            tmpl.querySelector('.card-title').innerHTML = `<a href="${url}" title="${q.title}">${q.title}</a>`;
            tmpl.querySelector('.address').innerText = `${q.district}, ${q.city}`;
            tmpl.querySelector('.room-size').innerText = q.unit_size;
            tmpl.querySelector('.tag-info-bottom').innerText = ''

            if (q.property_style && q.property_style.length && q.property_style[0].style && q.property_style[0].style.name) {
                tmpl.querySelector('.tag-info-bottom').innerText = '#'+q.property_style[0].style.name;
            }

            let tags = '';
            if (q.rented_room < q.total_room && q.is_co_living) {
                let price = dashboard.formatPrice(q.co_living_min_price);
                let room = `${q.rented_room} / ${q.total_room}`;

                tags += `<span id="tag-left-${i}" class="card-tag fox-btn-left" data-id="${i}" data-type="coliving" data-active="1" data-img="/img/coliving-icon.png" data-room="${room}" data-price="${q.co_living_min_price}">Co Living</span> `;
                tmpl.querySelector('.starting-price').id = `price-${i}`;
                tmpl.querySelector('.starting-price').innerText = `${price} / Room / Month`;
                tmpl.querySelector('.img-type').id = `icon-${i}`;
                tmpl.querySelector('.available-room').id = `room-${i}`;
                tmpl.querySelector('.available-room').innerText = room;
            }
            if (q.available_room === q.total_room && q.is_entire_space) {
                let state = q.rented_room === 0 && q.is_co_living ? 'card-tag-outline' : '';
                let price = dashboard.formatPrice(q.entire_space_min_price);

                tags += `<span id="tag-right-${i}" class="card-tag fox-btn-right ${state}" data-id="${i}" data-type="entire" data-active="0" data-img="/img/ic_bedroom.png" data-room="${q.total_room}" data-price="${q.entire_space_min_price}">Entire House</span>`;
                if (!q.is_co_living) {
                    tmpl.querySelector('.starting-price').id = `price-${i}`;
                    tmpl.querySelector('.starting-price').innerText = `${price} / Month`;
                    tmpl.querySelector('.img-type').id = `icon-${i}`;
                    tmpl.querySelector('.img-type').src = `/img/ic_bedroom.png`;
                    tmpl.querySelector('.available-room').id = `room-${i}`;
                    tmpl.querySelector('.available-room').innerText = `${q.total_room}`;
                }
            }

            if (!tags) {
                tags = '&nbsp;';
            }

            tmpl.querySelector('.tags').innerHTML = tags;

            let navigation = document.getElementById('navigation').content.cloneNode(true);
            navigation.querySelector('.carousel-control-prev').href = `#carousel-search-item-${i}`;
            navigation.querySelector('.carousel-control-next').href = `#carousel-search-item-${i}`;
            tmpl.querySelector('.carousel').appendChild(navigation);

            let carousel = dashboard.renderImage({ photos: q.photos, pageUrl: url, id: i });
            tmpl.querySelector('.card-img-top').id = `carousel-search-item-${i}`;
            tmpl.querySelector('.carousel-inner').innerHTML = carousel[0];
            tmpl.querySelector('.carousel-indicators').innerHTML = carousel[1];

            let liked = dashboard.state.user.property_favorites;
            tmpl.querySelector('.btn-favorite').setAttribute('data-id', q.id);
            if (liked.includes(q.id)) {
                tmpl.querySelector('.btn-favorite').classList.add('like-active');
            }

            return tmpl;
        },
        renderImage: function ({ photos, pageUrl, id }) {
            let images = '';
            let buttons = '';

            photos && photos.length && photos[0].thumb_images && photos[0].thumb_images.length && photos[0].thumb_images.forEach((q, i) => {
                images += `<a href="${pageUrl}" class="carousel-item ${i === 0 ? 'active' : ''}"><img class="d-block w-100" src="${q.url}"></a>`;
                buttons += `<li data-target="#carousel-search-item-${id}" data-slide-to="${i}" class="${i === 0 ? 'active' : ''}"></li>`
            });

            return [images, buttons];
        },
    }
    if ($parent.length) {
        dashboard.init();
    }
});
