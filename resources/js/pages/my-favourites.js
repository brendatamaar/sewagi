$(document).ready(function () {
    $parent = $("#myFavourites");
    const favourites = {
        init: function () {
            this.initialize();
            this.favouritesProperties();
            this.popularProperties();
        },
        state: {
            user: {}
        },
        initialize: function() {
            const user = JSON.parse($('#user').val());
            this.state.user = user;

            $(document).on('click', '.card-tag', function () {
                if (!$(this).hasClass('card-tag-outline')) {
                    return;
                }

                let state = $(this).data('active');
                let type = $(this).data('type');
                let id = $(this).data('id');
                let price = favourites.formatPrice($(this).data('price'));
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
                            favourites.favouritesProperties();
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
                            favourites.favouritesProperties();
                        })
                        .catch(error => console.log(error));
                }
            });
        },
        favouritesProperties: function() {
            fetch('/dashboard/favourites-property?limit=12')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return favourites.renderData(data, 'my-favourites-property', 'fav');
                    }

                    $('#section-my-favourites').hide();
                })
                .catch(error => console.log(error));
        },
        popularProperties: function() {
            fetch('/dashboard/popular-property')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        return favourites.renderData(data, 'popular-property', 'fav');
                    }

                    $('#section-popular').hide();
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
                const tmpl = favourites.renderCard(q, newId);
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
                let price = favourites.formatPrice(q.co_living_min_price);
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
                let price = favourites.formatPrice(q.entire_space_min_price);

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

            let carousel = favourites.renderImage({ photos: q.photos, pageUrl: url, id: i });
            tmpl.querySelector('.card-img-top').id = `carousel-search-item-${i}`;
            tmpl.querySelector('.carousel-inner').innerHTML = carousel[0];
            tmpl.querySelector('.carousel-indicators').innerHTML = carousel[1];

            let liked = favourites.state.user.property_favorites;
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
        favourites.init();
    }
});
