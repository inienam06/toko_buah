/*jslint browser: true*/
/*global $, jQuery, alert*/

$(document).ready(function () {

    "use strict";

    var body = $("body");

    $(function () {
        $(".preloader").fadeOut();
        $('#side-menu').metisMenu();
    });

    /* ===== Theme Settings ===== */

    $(".open-close").on("click", function () {
        body.toggleClass("show-sidebar").toggleClass("hide-sidebar");
        $(".sidebar-head .open-close i").toggleClass("ti-menu");
    });

    /* ===== Open-Close Right Sidebar ===== */

    $(".right-side-toggle").on("click", function () {
        $(".right-sidebar").slideDown(50).toggleClass("shw-rside");
        $(".fxhdr").on("click", function () {
            body.toggleClass("fix-header"); /* Fix Header JS */
        });
        $(".fxsdr").on("click", function () {
            body.toggleClass("fix-sidebar"); /* Fix Sidebar JS */
        });

        /* ===== Service Panel JS ===== */

        var fxhdr = $('.fxhdr');
        if (body.hasClass("fix-header")) {
            fxhdr.attr('checked', true);
        } else {
            fxhdr.attr('checked', false);
        }
    });

    /* ===========================================================
        Loads the correct sidebar on window load.
        collapses the sidebar on window resize.
        Sets the min-height of #page-wrapper to window size.
    =========================================================== */

    $(function () {
        var set = function () {
                var topOffset = 60,
                    width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width,
                    height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
                if (width < 768) {
                    $('div.navbar-collapse').addClass('collapse');
                    topOffset = 100; /* 2-row-menu */
                } else {
                    $('div.navbar-collapse').removeClass('collapse');
                }

                /* ===== This is for resizing window ===== */

                if (width < 1170) {
                    body.addClass('content-wrapper');
                    $(".sidebar-nav, .slimScrollDiv").css("overflow-x", "visible").parent().css("overflow", "visible");
                } else {
                    body.removeClass('content-wrapper');
                }

                height = height - topOffset;
                if (height < 1) {
                    height = 1;
                }
                if (height > topOffset) {
                    $("#page-wrapper").css("min-height", (height) + "px");
                }
            }
        $(window).ready(set);
        $(window).bind("resize", set);
    });

    /* ===== Collapsible Panels JS ===== */

    (function ($, window, document) {
        var panelSelector = '[data-perform="panel-collapse"]',
            panelRemover = '[data-perform="panel-dismiss"]';
        $(panelSelector).each(function () {
            var collapseOpts = {
                    toggle: false
                },
                parent = $(this).closest('.panel'),
                wrapper = parent.find('.panel-wrapper'),
                child = $(this).children('i');
            if (!wrapper.length) {
                wrapper = parent.children('.panel-heading').nextAll().wrapAll('<div/>').parent().addClass('panel-wrapper');
                collapseOpts = {};
            }
            wrapper.collapse(collapseOpts).on('hide.bs.collapse', function () {
                child.removeClass('ti-minus').addClass('ti-plus');
            }).on('show.bs.collapse', function () {
                child.removeClass('ti-plus').addClass('ti-minus');
            });
        });

        /* ===== Collapse Panels ===== */

        $(document).on('click', panelSelector, function (e) {
            e.preventDefault();
            var parent = $(this).closest('.panel'),
                wrapper = parent.find('.panel-wrapper');
            wrapper.collapse('toggle');
        });

        /* ===== Remove Panels ===== */

        $(document).on('click', panelRemover, function (e) {
            e.preventDefault();
            var removeParent = $(this).closest('.panel');

            function removeElement() {
                var col = removeParent.parent();
                removeParent.remove();
                col.filter(function () {
                    return ($(this).is('[class*="col-"]') && $(this).children('*').length === 0);
                }).remove();
            }
            removeElement();
        });
    }(jQuery, window, document));

    /* ===== Tooltip Initialization ===== */

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    /* ===== Popover Initialization ===== */

    $(function () {
        $('[data-toggle="popover"]').popover();
    });

    /* ===== Task Initialization ===== */

    $(".list-task li label").on("click", function () {
        $(this).toggleClass("task-done");
    });
    $(".settings_box a").on("click", function () {
        $("ul.theme_color").toggleClass("theme_block");
    });

    /* ===== Collepsible Toggle ===== */

    $(".collapseble").on("click", function () {
        $(".collapseblebox").fadeToggle(350);
    });

    /* ===== Sidebar ===== */

    $('.slimscrollright').slimScroll({
        height: '100%',
        position: 'right',
        size: "5px",
        color: '#dcdcdc'
    });
    $('.slimscrollsidebar').slimScroll({
        height: '100%',
        position: 'right',
        size: "6px",
        color: 'rgba(0,0,0,0.3)'
    });
    $('.chat-list').slimScroll({
        height: '100%',
        position: 'right',
        size: "0px",
        color: '#dcdcdc'
    });

    /* ===== Resize all elements ===== */

    body.trigger("resize");

    /* ===== Visited ul li ===== */

    $('.visited li a').on("click", function (e) {
        $('.visited li').removeClass('active');
        var $parent = $(this).parent();
        if (!$parent.hasClass('active')) {
            $parent.addClass('active');
        }
        e.preventDefault();
    });

    /* ===== Login and Recover Password ===== */

    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    /* ================================================================= 
        Update 1.5
        this is for close icon when navigation open in mobile view
    ================================================================= */

    $(".navbar-toggle").on("click", function () {
        $(".navbar-toggle i").toggleClass("ti-menu").addClass("ti-close");
    });
});

function getMapFromLatLng(tipe) {
    var callback = null;
    switch (tipe) {
        case 1:
            callback = getMap;
            break;
    
        default:
            callback = getMap;
            break;
    }

    var last = $('script[data-tipe="last"]');
    last.after('<script type="text/javascript" data-tipe="map-sync" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRYlbl07CUjMrEA2G5VNBqNkm-bwZjI7s&libraries=places&callback='+callback+'" async defer></script>');
}

function getMap() {
    try {
        var parent = $('.parent');
        var lat = parent.find('input[data-tipe="lat"]');
        var lng = parent.find('input[data-tipe="lng"]');

        var geocoder = new google.maps.Geocoder;
        var loc = parent.find('textarea#lokasi');
        var map = new google.maps.Map(parent.find('div#map'), {
        center: {
            lat: -6.2569821, 
            lng: 106.5611073
            },
        zoom: 17,
        mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
        });

        var markers = [];

        markers.push(new google.maps.Marker({
        map: map,
        draggable: true,
        position: {lat: (lat.val() != '') ? parseFloat(lat.val()) : -6.2569821, lng: (lng.val() != '') ? parseFloat(lng.val()) : 106.5611073}
        }));

        lat.val(markers[0].position.lat());
        lng.val(markers[0].position.lng());    
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        loc.val(input.value);

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
            }

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
            map: map,
            title: place.name,
            draggable: true,
            position: place.geometry.location
            }));

            lat.val(markers[0].position.lat());
            lng.val(markers[0].position.lng()); 

            if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
            } else {
            bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);

        for (var i = 0; i < markers.length; i++) {
            google.maps.event.addListener(markers[i], 'dragend', function() {
            lat.val(markers[0].position.lat());
            lng.val(markers[0].position.lng());

            var latlng = {lat: parseFloat(lat.val()), lng: parseFloat(lng.val())};

            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        try {
                            if(loc.length > 0)
                            {
                                if(loc.val() == '' || loc.val() == input.value)
                                {
                                loc.val(results[0].formatted_address);
                                }
                            }

                            input.value = results[0].formatted_address;
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
                });
            });
        }
        });

        for (var i = 0; i < markers.length; i++) {
        google.maps.event.addListener(markers[i], 'dragend', function() {
            lat.val(markers[0].position.lat());
            lng.val(markers[0].position.lng());
            
            var latlng = {lat: parseFloat(lat.val()), lng: parseFloat(lng.val())};

            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        try {
                            if(loc.length > 0)
                            {
                                if(loc.val() == '' || loc.val() == input.value)
                                {
                                loc.val(results[0].formatted_address);
                                }
                            }

                            input.value = results[0].formatted_address;
                        } catch (error) {
                            console.log(error);
                        }
                    }
                }
            });
        });
        }
    } catch (error) {
        return true;
    }
}

function startLoading()
{
    $('.preloader').show();
}

function stopLoading()
{
    $('.preloader').hide();
}

function antar_pesanan(data)
{
    startLoading();

    $.ajax({
        headers: {
            apikey: getApiKey(),
            Authorization: data.auth
        },
        method: 'GET',
        url: getUrlApi()+'admin/pesanan/baru/antar/'+data.id
    }).done(function(response){
        stopLoading();
        alertToUrl('Berhasil', response.message, 'success', data.url);
    });
}

function pesanan_telah_sampai(data)
{
    startLoading();

    $.ajax({
        headers: {
            apikey: getApiKey(),
            Authorization: data.auth
        },
        method: 'GET',
        url: getUrlApi()+'admin/pesanan/sedang-diantar/telah-sampai/'+data.id
    }).done(function(response){
        stopLoading();
        alertToUrl('Berhasil', response.message, 'success', data.url);
    });
}