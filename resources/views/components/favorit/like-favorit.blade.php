<script>
    async function likeFavorit(value, targetType) {
        let data;
        let postData;
        if (targetType == 'villa') {
            await $.ajax({
                type: "GET",
                url: `/like/villa/${value}`,
                data: {
                    villa: value,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    data = response;
                    changeColorFavorite(data, value, targetType);
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON.errors) {
                        for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                            iziToast.error({
                                title: "Error",
                                message: jqXHR.responseJSON.errors[i],
                                position: "topRight",
                            });
                        }
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                    }
                    return;
                }
            });
        }
        if (targetType == 'restaurant') {
            await $.ajax({
                type: "GET",
                url: `/like/restaurant/${value}`,
                data: {
                    restaurant: value,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    data = response;
                    changeColorFavorite(data, value, targetType);
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON.errors) {
                        for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                            iziToast.error({
                                title: "Error",
                                message: jqXHR.responseJSON.errors[i],
                                position: "topRight",
                            });
                        }
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                    }
                    return;
                }
            });
        }
        if (targetType == 'hotel') {
            await $.ajax({
                type: "GET",
                url: `/like/hotel/${value}`,
                data: {
                    hotel: value,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    data = response;
                    changeColorFavorite(data, value, targetType);
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON.errors) {
                        for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                            iziToast.error({
                                title: "Error",
                                message: jqXHR.responseJSON.errors[i],
                                position: "topRight",
                            });
                        }
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                    }
                    return;
                }
            });
        }
        if (targetType == 'activity') {
            await $.ajax({
                type: "GET",
                url: `/like/things-to-do/${value}`,
                data: {
                    activity: value,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    data = response;
                    changeColorFavorite(data, value, targetType);
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON.errors) {
                        for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                            iziToast.error({
                                title: "Error",
                                message: jqXHR.responseJSON.errors[i],
                                position: "topRight",
                            });
                        }
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                    }
                    return;
                }
            });
        }
        if (targetType == 'collaborator') {
            await $.ajax({
                type: "GET",
                url: `/like/collaborator/${value}`,
                data: {
                    id_collab: value,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    data = response;
                    changeColorFavorite(data, value, targetType);
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.responseJSON.errors) {
                        for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                            iziToast.error({
                                title: "Error",
                                message: jqXHR.responseJSON.errors[i],
                                position: "topRight",
                            });
                        }
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.message,
                            position: "topRight",
                        });
                    }
                    return;
                }
            });
        }
    }
    function changeColorFavorite(data, value, targetType) {
        if (data) {
            if (data == 1) {
                console.log('like == true');
                $(`.likeButton${targetType+value}`).removeClass('favorite-button');
                $(`.likeButton${targetType+value}`).addClass('favorite-button-active');
                $(`.unlikeButton${targetType+value}`).removeClass('favorite-button');
                $(`.unlikeButton${targetType+value}`).addClass('favorite-button-active');

                $(`.like-sign-${targetType}-${value}`).fadeIn();
                setTimeout(function() {
                    $(`.like-sign-${targetType}-${value}`).fadeOut();
                }, 900);
            } else if (data == 0) {
                console.log('like == false');
                $(`.likeButton${targetType+value}`).removeClass('favorite-button-active');
                $(`.likeButton${targetType+value}`).addClass('favorite-button');
                $(`.unlikeButton${targetType+value}`).removeClass('favorite-button-active');
                $(`.unlikeButton${targetType+value}`).addClass('favorite-button');
            }
            // console.log('hit likeFavoriteMap');
            // console.log('likeButton : '+$(`.likeButton${targetType+value}`).attr('class'));
            // console.log('unlikeButton : '+$(`.unlikeButton${targetType+value}`).attr('class'));
            // console.log('like-sign : '+$(`.like-sign-${targetType}-${value}`).attr('class'));
        }
    }
</script>

