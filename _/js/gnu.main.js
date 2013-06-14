/*

    GNU - gnu.com
    VERSION 1.2
    AUTHOR brian.behrens@mervin.com

    DEPENDENCIES:
    - jQuery v1.8.3
    - Shopatron API v2.2.0
    - Modernizr v2.6.1
    - ColorBox v1.3.20
    - jQuery bxSlider v3.0
    - jQuery Treeview v1.5
    - embedagram

*/

var GNU = GNU || {};

GNU.main = {
    config: {
        selectedMenu: ''
    },
    init: function () {
        var self = this;

        self.initShopatron();
        self.regionSelectorInit();
        self.megaMenuInit();

        if ($('body').hasClass('home')) {
            self.homeInit();
        } else if ($('body').hasClass('single-gnu_snowboards')) {
            self.snowboardProductInit();
        } else if ($('body').hasClass('page-template-page-overview-bindings-php')) {
            self.bindingOverviewInit();
        } else if ($('body').hasClass('single-gnu_bindings')) {
            self.bindingProductInit();
        } else if ($('body').hasClass('single-gnu_weirdwear')) {
            self.weirdwearProductInit();
        } else if ($('body').hasClass('single-gnu_accessories')) {
            self.accessoriesProductInit();
        } else if ($('body').hasClass('single-gnu_team')) {
            self.teamDetailsInit();
        } else if ($('body').hasClass('page-template-page-store-locator-php')) {
            self.storeLocatorInit();
        } else if ($('body').hasClass('single-post')) {
            self.blogSingleInit();
            self.blogInit();
        } else if ($('body').hasClass('blog') || $('body').hasClass('search') || $('body').hasClass('archive') || $('body').hasClass('error404')) {
            self.blogInit();
        }
    },
    initShopatron: function () {
        var self, lang, regionCookie, shopAPIKey, shopAPIKeyString;
        self = this;
        // check the language on the cookie
        regionCookie = self.utilities.cookie.getCookie('GNURegion');
        if (regionCookie != null || regionCookie != "") {
            lang = regionCookie;
        }
        if (lang) {
            if (lang === 'ca') {
                shopAPIKey = "iyzc7e8i"; // CA Key
                // set shopatron footer links for Canada
                $('#link-privacy').attr('href', 'http://gnu-ca.shptron.com/home/privacy/4374.7.1.2');
                $('#link-policies').attr('href', 'http://gnu-ca.shptron.com/home/policies/4374.7.1.2');
                $('#link-login').attr('href', 'http://gnu-ca.shptron.com/account/?mfg_id=4374.7&language_id=1');
                $('#link-safety').attr('href', 'http://gnu-ca.shptron.com/home/security/4374.7.1.2');
                $('#link-returns').attr('href', 'http://gnu-ca.shptron.com/home/policies/4374.7.1.2#Returns');
                $('#link-ordering').attr('href', 'http://gnu-ca.shptron.com/home/ordering/4374.7.1.2');
            } else {
                shopAPIKey = "a29smylj"; // US Key
            }
        } else {
            shopAPIKey = "a29smylj"; // US Key
        }
        shopAPIKeyString = '{"apiKey": "' + shopAPIKey + '"}';
        // add key to the body of the page for shopatron's api to grab via ID
        $("body").append('<div id="shopatronCart">' + shopAPIKeyString + '</div>');
        // request the shopatron api
        $.ajax({
            url: "//mediacdn.shopatron.com/media/js/product/shopatronAPI-2.2.0.min.js",
            dataType: "script",
            success: function (data) {
                // request other aditional api for quick cart and shopping cart
                $.ajax({
                    url: "//mediacdn.shopatron.com/media/js/product/shopatronJST-2.2.0.min.js",
                    dataType: "script",
                    success: function (data) {
                        // init the shopatron page elements
                        self.quickCartInit();
                        if ($('body').hasClass('page-template-page-shopping-cart-php')) {
                            self.shoppingCartInit();
                        }
                    }
                });
            }
        });
    },
    megaMenuInit: function () {
        var self;
        self = this;
        // add listeners to top menu items that have drop downs
        $("#nav-primary .snowboards").click(function (e) {
            e.preventDefault();
            toggleMenu($(this).attr("class"));
        });
        $("#nav-primary .bindings").click(function (e) {
            e.preventDefault();
            toggleMenu($(this).attr("class"));
        });
        $("#nav-primary .weirdwear").click(function (e) {
            e.preventDefault();
            toggleMenu($(this).attr("class"));
        });
        $("#nav-primary .weirdos").click(function (e) {
            e.preventDefault();
            toggleMenu($(this).attr("class"));
        });
        // main toggle function for animating the state of the drop down menu
        function toggleMenu ( linkClass ) {
            // uninit homepage takeover
            if ($('body').hasClass('home')) {
                self.homeTakeoverUninit();
            }
            // remove selected class from all drop down nav items
            $('.nav-dropdown nav').each( function (index) {
                $(this).removeClass("selected");
            });
            // add to selected item
            var navToDisplay = "nav.nav-dropdown-" + linkClass;
            $(navToDisplay).addClass("selected");

            if (self.config.selectedMenu === '') {
                // expand container div
                $("#header .nav-dropdown-container-hide-overflow").addClass("selected");
                // expand menu with JS
                $('#header .nav-dropdown-container').animate({
                    top: 0
                }, {
                    duration: 600,
                    easing: 'swing',
                    complete: function () {
                        // make sure selected class wasn't removed
                        $("#header .nav-dropdown-container-hide-overflow").addClass("selected");
                    }
                });
                // set selected link
                self.config.selectedMenu = linkClass;
            } else if ( linkClass === self.config.selectedMenu ) {
                // collapse menu with JS
                $('#header .nav-dropdown-container').animate({
                    top: '-800px'
                }, {
                    duration: 400,
                    easing: 'swing',
                    complete: function () {
                        $("#header .nav-dropdown-container-hide-overflow").removeClass("selected"); // contract dropdown container
                    }
                });
                // set the selected link to nothing
                self.config.selectedMenu = '';
            } else {
                // if menu is open and another menu item is clicked
                self.config.selectedMenu = linkClass;
            }
        }
        // drop down close button
        $("#header .nav-dropdown-footer .dropdown-close-wrapper a").click(function (e) {
            e.preventDefault();
            // collapse menu with JS
            $('#header .nav-dropdown-container').animate({
                top: '-800px'
            }, {
                duration: 400,
                easing: 'swing',
                complete: function () {
                    $("#header .nav-dropdown-container-hide-overflow").removeClass("selected"); // contract dropdown container
                }
            });
            // set the selected link to nothing
            self.config.selectedMenu = '';
        });
    },
    regionSelectorInit: function () {
        // check language cookie on load
        var self, lang, regionCookie;
        self = this;

        regionCookie = self.utilities.cookie.getCookie('GNURegion');
        
        if (regionCookie != null || regionCookie != "") {
            lang = regionCookie;
        }

        if (lang) {
            if (lang === 'ca') {
                $(".country-ca").addClass("selected");
            } else if (lang === 'int') {
                $("body").addClass("international");
                $(".country-int").addClass("selected");
            } else {
                $(".country-us").addClass("selected");
            }
        } else {
            if (navigator.cookieEnabled === true) {
                // if no region cookie has been set, open selector
                self.regionSelectorOverlayInit();
                // pick us by default
                self.utilities.cookie.setCookie('GNURegion', 'us', 60);
                $(".country-us").addClass("selected");
            } else {
                // cookies are disabled
                $(".country-us").addClass("selected");
            }
        }
        // add click events
        $(".country-us, .country-ca, .country-int").click(function (e) {
            e.preventDefault();
            if (navigator.cookieEnabled === false) {
                alert('Enable cookies in your browser in order to select your region.');
            } else {
                self.regionSelectorOverlayInit();
            }
        });
    },
    regionSelectorOverlayInit: function () {
        var self = this;
        $.colorbox({inline: true, href: "#region-selector-overlay", opacity: .8});
        // add click events
        $("#region-selector-overlay .usa").click(function (e) {
            e.preventDefault();
            self.utilities.cookie.setCookie('GNURegion', 'us', 60);
            window.location.reload();
        });
        $("#region-selector-overlay .canada").click(function (e) {
            e.preventDefault();
            self.utilities.cookie.setCookie('GNURegion', 'ca', 60);
            window.location.reload();
        });
        $("#region-selector-overlay .international").click(function (e) {
            e.preventDefault();
            self.utilities.cookie.setCookie('GNURegion', 'int', 60);
            window.location.reload();
        });
    },
    homeInit: function () {
        var self = this;
        // hero slider
        $('.hero-slider ul').bxSlider({
            mode: 'fade',
            auto: true,
            pause: 10000,
            prevSelector: '#hero-prev',
            nextSelector: '#hero-next',
            autoHover: false,
            randomStart: false
        });
        // instagram photos
        $('#instagram-photos').embedagram({
            instagram_id: 14985997,
            thumb_width: 152,
            limit: 24,
            success: function () { $('#instagram-photos').bxSlider({displaySlideQty: 4, moveSlideQty: 4, prevSelector: '#insta-prev', nextSelector: '#insta-next', auto: true, pause: 6000, autoHover: true}); }
        });
        //self.homeTakeoverInit();
    },
    homeTakeoverInit: function () {
        var self = this;
        $(window).load( function () {
            // animate mathieu
            $('#homepage-takeover .mathieu-crepel').css('left', '-515px');
            $('#homepage-takeover .mathieu-crepel').delay(500).animate({ left: 0 }, { duration: 500, easing: 'swing' });
            // animate snowboard
            $('#homepage-takeover .mathieu-crepel-snowboard').css('left', '-258px');
            $('#homepage-takeover .mathieu-crepel-snowboard').delay(800).animate({ left: 0 }, { duration: 500, easing: 'swing' });
            // animate close
            $('#homepage-takeover .mathieu-crepel-close').css('left', '-120px');
            $('#homepage-takeover .mathieu-crepel-close').delay(1200).animate({
                left: 343
            }, {
                duration: 200,
                easing: 'swing',
                complete: function () {
                    // assign click event to close
                    $('#homepage-takeover .mathieu-crepel-close').click(function () {
                        self.homeTakeoverUninit();
                        return false;
                    });
                    // assign hover event to others
                    $('#homepage-takeover').hover(
                        function () {
                            $('#homepage-takeover .mathieu-crepel').animate({ bottom: -5 }, { duration: 100, easing: 'swing' });
                            $('#homepage-takeover .mathieu-crepel-snowboard').animate({ top: -5 }, { duration: 100, easing: 'swing' });
                        },
                        function () {
                            $('#homepage-takeover .mathieu-crepel').animate({ bottom: 0 }, { duration: 100, easing: 'swing' });
                            $('#homepage-takeover .mathieu-crepel-snowboard').animate({ top: 0 }, { duration: 100, easing: 'swing' });
                        }
                    );
                    // assign click event to others
                    $('#homepage-takeover').click(function () {
                        window.location.href = "/team/mathieu-crepel/";
                    });
                }
            });
            $('#homepage-takeover').addClass('visible');
        });
    },
    homeTakeoverUninit: function () {
        // unbind hover
        $("#homepage-takeover").unbind('mouseenter mouseleave');
        // animate
        $('#homepage-takeover .mathieu-crepel-close').animate({ left: -120 }, { duration: 300, easing: 'swing' });
        $('#homepage-takeover .mathieu-crepel-snowboard').delay(200).animate({ left: -258 }, { duration: 400, easing: 'swing' });
        $('#homepage-takeover .mathieu-crepel').delay(300).animate({
            left: -515
        }, {
            duration: 300,
            easing: 'swing',
            complete: function () {
                $('#homepage-takeover').removeClass('visible');
            }
        });
    },
    snowboardProductInit: function () {
        var self = this;

        // selecting the proper tab at start
        $('.product-navigation ul li a:first').addClass('selected');
        $('#board-details, #weird-science, #board-specs, #interview').addClass("hide");
        $('#board-details').removeClass("hide");
        $('#board-details').addClass("show");
        // on click change tab
        $('.product-navigation ul li a').click(function (e) {
            e.preventDefault();
            $('.product-navigation ul li a').removeClass('selected');
            $(this).addClass('selected');
            $('#board-details, #weird-science, #board-specs, #interview').removeClass("show");
            $('#board-details, #weird-science, #board-specs, #interview').addClass("hide");
            $($(this).attr('href')).removeClass("hide");
            $($(this).attr('href')).addClass("show");
            // currently blocking deep link, need to address
            var url = $(this).attr('href');
            self.utilities.pageScroll(url);
        });
        // weird science slider
        $('#science-photos').bxSlider({
            displaySlideQty: 4,
            moveSlideQty: 1,
            prevSelector: '#science-prev',
            nextSelector: '#science-next',
            auto: false,
            pause: 6000,
            autoHover: true
        });
        // check for product video callout
        if ($('.product-video')) {
            var topInit = $('.product-video a').css('top');
            $('.product-video a').css('top', '-300px');
            $(window).load( function () {
                // animate callout after everything is loaded
                $('.product-video a').animate({
                    top: topInit
                }, {
                    duration: 1000,
                    easing: 'swing',
                    complete: function () { }
                });
            });
            // smooth scroll on click
            $('.product-video a').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                self.utilities.pageScroll(url);
            });
        };
        // grab any gallery images and turn them into a lightbox
        $('.product-images #image-list li a').colorbox({rel: 'productImages', opacity: 1});
        // grab view all specs link and turn into lightbox
        $('a.get_specs').colorbox({width: 980, height: 600, iframe: true, opacity: 1});
        // scroll page when tech items clicked
        $('.product-highlights .product-tech a').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            self.utilities.pageScroll(url);
        });
        // assign the slider to a variable
        var slider = $('#image-list').bxSlider({
            controls: false,
            mode: 'fade',
            speed: 200
        });
        // assign a click event to the external thumbnails
        $('.image-list-thumbs a').click(function () {
            var thumbIndex = $('.image-list-thumbs a').index(this);
            // call the "goToSlide" public function
            slider.goToSlide(thumbIndex); // skip overview index

            // remove all active classes
            $('.image-list-thumbs a').removeClass('pager-active');
            // assisgn "pager-active" to clicked thumb
            $(this).addClass('pager-active');
            // very important! you must kill the links default behavior
            return false;
        });
        // assign "pager-active" class to the first thumb
        $('.image-list-thumbs a:first').addClass('pager-active');

        // select the appropriate board
        $('#product-variation').change(function () {
            // select the correct image
            var boardSKU, boardThumbs;
            boardSKU = $(this).val();
            boardSKUs = [];

            if (boardSKU != "-1") {
                $('#product-variation-label').removeClass('alert');
            }

            $(".image-list-thumbs li a").each(function(){
                var skus = $(this).attr('data-sku');
                boardSKUs.push([$(this), skus]);
            });

            for (var i=0; i < boardSKUs.length; i++) {
                var skus = boardSKUs[i][1];

                if (skus.indexOf(boardSKU) != -1) {
                    boardSKUs[i][0].click();
                }
            }
        });

        // add to cart api btn
        $('a.add-to-cart').click(function (e) {
            e.preventDefault();
            var boardSKU;
            // check size selection
            boardSKU = $('#product-variation').val();
            if (boardSKU === "-1") {
                // add alert to class
                $('#product-variation-label').addClass('alert');
                return;
            }
            // hide add to cart, show loading while request is made
            $('.product-buy ul li.loading').addClass('visible').removeClass('hidden');
            $('.product-buy ul li.cart-button').addClass('hidden').removeClass('visible');
            // call shopatron's api
            Shopatron.addToCart({
                quantity: '1', // Optional: Defaults to 1 if not set
                partNumber: boardSKU // Required: This is the product that will be added to the cart.
            }, {
                // All event handlers are optional
                success: function (data, textStatus) {
                    $('.product-buy .cart-success').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-failure').addClass('hidden').removeClass('visible');
                },
                error: function (textStatus, errorThrown) {
                    $('.product-buy .cart-failure').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-success').addClass('hidden').removeClass('visible');
                },
                complete: function (textStatus) {
                    $('.product-buy ul li.loading').addClass('hidden').removeClass('visible');
                    $('.product-buy ul li.cart-button').addClass('visible').removeClass('hidden');
                }
            });
        });
    },
    bindingOverviewInit: function () {
        var self = this;
        $('.binding-animation ul').bxSlider({
            mode: 'fade',
            auto: true,
            pause: 5000,
            prevSelector: '.animation-prev',
            nextSelector: '.animation-next',
            autoHover: true,
            randomStart: false
        });
        GNU.BindingsCompare.init(); // initialize binding comparison class
    },
    bindingProductInit: function () {
        var self = this;

        // assign the slider to a variable
        var slider = $('#image-list').bxSlider({
            controls: false,
            mode: 'fade',
            speed: 200
        });
        // assign a click event to the external thumbnails
        $('.image-list-thumbs a').click(function () {
            var thumbIndex = $('.image-list-thumbs a').index(this);
            // call the "goToSlide" public function
            slider.goToSlide(thumbIndex); // skip overview index
            // remove all active classes
            $('.image-list-thumbs a').removeClass('pager-active');
            // assisgn "pager-active" to clicked thumb
            $(this).addClass('pager-active');
            // very important! you must kill the links default behavior
            return false;
        });
        // assign "pager-active" class to the first thumb
        $('.image-list-thumbs a:first').addClass('pager-active');
        // on view more images click, setup clorbox
        $('.product-images #image-list li a').click(function (e) {
            e.preventDefault();
            var additionalImages, imageTitle;
            additionalImages = $(this).attr('data-additional-images');
            if (additionalImages != "") {
                additionalImages = additionalImages.split(',');
                imageTitle = $(this).attr('title');
                // add hidden images
                $("#hidden-images").html("");
                $.each( additionalImages, function(i, imageUrl){
                    $("#hidden-images").append('<li><a href="' + imageUrl + '" title="' + imageTitle + '"></a></li>');
                });
            }
            // add main image to colorbox
            $(this).colorbox({rel: imageTitle, opacity: 1});
            // add additional images to colorbox and open
            if(additionalImages != ""){
                $("#hidden-images li a").colorbox({rel: imageTitle, open: true, opacity: 1});
            }
        });
        // check for product video callout
        if ($('.product-video')) {
            var topInit = $('.product-video a').css('top');
            $('.product-video a').css('top', '-300px');
            $(window).load( function () {
                // animate callout after everything is loaded
                $('.product-video a').animate({
                    top: topInit
                }, {
                    duration: 1000,
                    easing: 'swing',
                    complete: function () { }
                });
            });
            // smooth scroll on click
            $('.product-video a').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                self.utilities.pageScroll(url);
            });
        };
        // select the appropriate binding
        $('#product-variation').change(function () {
            // select the correct image
            var productSKU, boardThumbs;
            productSKU = $(this).val();
            productSKUs = [];

            if (productSKU != "-1") {
                $('#product-variation-label').removeClass('alert');
            }

            $(".image-list-thumbs li a").each(function(){
                var skus = $(this).attr('data-sku');
                productSKUs.push([$(this), skus]);
            });

            for (var i=0; i < productSKUs.length; i++) {
                var skus = productSKUs[i][1];

                if (skus.indexOf(productSKU) != -1) {
                    productSKUs[i][0].click();
                }
            }
        });
        // add to cart api btn
        $('a.add-to-cart').click(function (e) {
            e.preventDefault();
            var productSKU;
            // check size selection
            productSKU = $('#product-variation').val();
            if (productSKU === "-1") {
                // add alert to class
                $('#product-variation-label').addClass('alert');
                return;
            }
            // hide add to cart, show loading while request is made
            $('.product-buy ul li.loading').addClass('visible').removeClass('hidden');
            $('.product-buy ul li.cart-button').addClass('hidden').removeClass('visible');
            // call shopatron's api
            Shopatron.addToCart({
                quantity: '1', // Optional: Defaults to 1 if not set
                partNumber: productSKU // Required: This is the product that will be added to the cart.
            }, {
                // All event handlers are optional
                success: function (data, textStatus) {
                    $('.product-buy .cart-success').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-failure').addClass('hidden').removeClass('visible');
                },
                error: function (textStatus, errorThrown) {
                    $('.product-buy .cart-failure').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-success').addClass('hidden').removeClass('visible');
                },
                complete: function (textStatus) {
                    $('.product-buy ul li.loading').addClass('hidden').removeClass('visible');
                    $('.product-buy ul li.cart-button').addClass('visible').removeClass('hidden');
                }
            });
        });
    },
    weirdwearProductInit: function () {
        var self = this;
        // grab any gallery images and turn them into a lightbox
        $('.product-images #image-list li a').colorbox({rel: 'productImages', opacity: 1});
        // assign the slider to a variable
        var slider = $('#image-list').bxSlider({
            controls: false,
            mode: 'fade',
            speed: 200
        });
        // assign a click event to the external thumbnails
        $('.image-list-thumbs a').click(function () {
            var thumbIndex = $('.image-list-thumbs a').index(this);
            // call the "goToSlide" public function
            slider.goToSlide(thumbIndex); // skip overview index

            // remove all active classes
            $('.image-list-thumbs a').removeClass('pager-active');
            // assisgn "pager-active" to clicked thumb
            $(this).addClass('pager-active');
            // very important! you must kill the links default behavior
            return false;
        });
        // assign "pager-active" class to the first thumb
        $('.image-list-thumbs a:first').addClass('pager-active');
        // product specs window
        $('a.get_specs').colorbox({width: 960, height: 400, iframe: true, opacity: 1});
        // select the appropriate product image
        $('#product-variation').change(function () {
            var productColor, productThumbs, productColors;
            productColor = $('option:selected', this).attr('data-color');
            productColors = [];

            if (productColor != "-1") {
                $('#product-variation-label').removeClass('alert');
            }

            $(".image-list-thumbs li a").each(function(){
                var color = $(this).attr('data-color');
                productColors.push([$(this), color]);
            });

            for (var i=0; i < productColors.length; i++) {
                var color = productColors[i][1];

                if (color.indexOf(productColor) != -1) {
                    productColors[i][0].click();
                    break;
                }
            }
        });
        // add to cart api btn
        $('a.add-to-cart').click(function (e) {
            e.preventDefault();
            var productSKU;
            // check size selection
            productSKU = $('#product-variation').val();
            if (productSKU === "-1") {
                // add alert to class
                $('#product-variation-label').addClass('alert');
                return;
            }
            // hide add to cart, show loading while request is made
            $('.product-buy ul li.loading').addClass('visible').removeClass('hidden');
            $('.product-buy ul li.cart-button').addClass('hidden').removeClass('visible');
            // call shopatron's api
            Shopatron.addToCart({
                quantity: '1', // Optional: Defaults to 1 if not set
                partNumber: productSKU // Required: This is the product that will be added to the cart.
            }, {
                // All event handlers are optional
                success: function (data, textStatus) {
                    $('.product-buy .cart-success').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-failure').addClass('hidden').removeClass('visible');
                },
                error: function (textStatus, errorThrown) {
                    $('.product-buy .cart-failure').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-success').addClass('hidden').removeClass('visible');
                },
                complete: function (textStatus) {
                    $('.product-buy ul li.loading').addClass('hidden').removeClass('visible');
                    $('.product-buy ul li.cart-button').addClass('visible').removeClass('hidden');
                }
            });
        });
    },
    accessoriesProductInit: function () {
        var self = this;
        
        // grab any gallery images and turn them into a lightbox
        $('.product-images #image-list li a').colorbox({rel: 'productImages', opacity: 1});
        // scroll page when tech items clicked
        $('.product-highlights .product-tech a').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            self.utilities.pageScroll(url);
        });

        // select the appropriate board
        $('#product-variation').change(function () {
            // select the correct image
            var boardSKU, boardThumbs;
            boardSKU = $(this).val();
            boardSKUs = [];

            if (boardSKU != "-1") {
                $('#product-variation-label').removeClass('alert');
            }

            $(".image-list-thumbs li a").each(function(){
                var skus = $(this).attr('data-sku');
                boardSKUs.push([$(this), skus]);
            });

            for (var i=0; i < boardSKUs.length; i++) {
                var skus = boardSKUs[i][1];

                if (skus.indexOf(boardSKU) != -1) {
                    boardSKUs[i][0].click();
                }
            }
        });
        // add to cart api btn
        $('a.add-to-cart').click(function (e) {
            e.preventDefault();
            var productQty, productSku;
            // get the quantity
            productQty = $('#product-qty').val();
            // get the sku
            productSku = $('#product-sku').val();
            // hide add to cart, show loading while request is made
            $('.product-buy ul li.loading').addClass('visible').removeClass('hidden');
            $('.product-buy ul li.cart-button').addClass('hidden').removeClass('visible');
            // call shopatron's api
            Shopatron.addToCart({
                quantity: productQty, // Optional: Defaults to 1 if not set
                partNumber: productSku // Required: This is the product that will be added to the cart.
            }, {
                // All event handlers are optional
                success: function (data, textStatus) {
                    $('.product-buy .cart-success').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-failure').addClass('hidden').removeClass('visible');
                },
                error: function (textStatus, errorThrown) {
                    $('.product-buy .cart-failure').addClass('visible').removeClass('hidden');
                    $('.product-buy .cart-success').addClass('hidden').removeClass('visible');
                },
                complete: function (textStatus) {
                    $('.product-buy ul li.loading').addClass('hidden').removeClass('visible');
                    $('.product-buy ul li.cart-button').addClass('visible').removeClass('hidden');
                }
            });
        });
    },
    teamDetailsInit: function () {
        if (typeof teamAlbumId != "undefined") {
            // SLIDESHOW Pro Embed
            var detailSlideShow = new SlideShowPro({
                attributes: {
                    id: 'album-' + teamAlbumId,
                    width: 632,
                    height: 400
                },
                mobile: {
                    auto: false
                },
                params: {
                    bgcolor: "#000000",
                    allowfullscreen: true,
                    wmode: "opaque"
                },
                flashvars: {
                    xmlFilePath: "http://director.quiksilver.com/images.php?album=" + teamAlbumId,
                    paramXMLPath: "http://director.quiksilver.com/m/params/techno.xml",
                    contentAreaBackgroundColor: "0x000000"
                }
            });
        }
        // assign a click event to the video thumbnails
        $('.video-thumbnails li a').click(function () {
            var videoID, videoType, videoPlayerHTML;
            videoID = $(this).attr('data-video-id');
            videoType = $(this).attr('data-video-type');
            // select the right thumbnail
            $('.video-thumbnails li a').removeClass('selected');
            $(this).addClass('selected');
            // display the video info
            $('.video-info').removeClass('selected');
            $('.video-player #' + videoID).addClass('selected');
            // add the video content
            if (videoType === "YouTube") {
                videoPlayerHTML = '<iframe width="632" height="356" src="http://www.youtube.com/embed/' + videoID + '" frameborder="0" allowfullscreen></iframe>';
            } else if (videoType === "Vimeo") {
                videoPlayerHTML = '<iframe src="http://player.vimeo.com/video/' + videoID + '" width="632" height="356" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
            }
            $('.video-player .frame-wrapper').html(videoPlayerHTML);
            // kill the links default behavior
            return false;
        });
        // select the first video
        $('.video-thumbnails li a:first').click();
        // set up instagram
        if (typeof $('.instagram').attr('data-instagram-username') != "undefined") {
            var instagramUsername = $('.instagram').attr('data-instagram-username');
            $.ajax({
                url: '/instagram-feed/?username=' + instagramUsername,
                dataType: 'json',
                success: function(data) {
                    // check to see if there are any items in the feed
                    if (typeof data.photos != "undefined") {
                        if (data.photos.length > 0) {
                            // show the feed if images exist
                            $('.instagram').removeClass('hidden');
                            // create the list items of images
                            var imgList = "";
                            for (var i = 0; i < data.photos.length; i++) {
                                var imgSrc, imgTitle, imgThumbSrc;
                                imgSrc = data.photos[i].image;
                                imgTitle = data.photos[i].title;
                                imgThumbSrc = imgSrc.replace("_7.jpg","_5.jpg");
                                imgList += '<li><a href="' + imgSrc + '" title="' + imgTitle + '"><img src="' + imgThumbSrc + '" alt="' + imgTitle + '" /></a></li>';
                                if (i == 39) {
                                    break;
                                }
                            }
                            $('#instagram-photos').html(imgList);
                            $('#instagram-photos').bxSlider({displaySlideQty: 4, moveSlideQty: 4, prevSelector: '#insta-prev', nextSelector: '#insta-next', auto: true, pause: 6000, autoHover: true});
                            $('#instagram-photos li.pager a').colorbox({rel: 'instaImages', opacity: 1});
                        }
                    }
                }
            });
        }
        if ($(".hero-slider ul li").length > 1) {
            // hero slider
            $('.hero-slider ul').bxSlider({
                mode: 'fade',
                auto: true,
                pause: 10000,
                prevSelector: '#hero-prev',
                nextSelector: '#hero-next',
                autoHover: false,
                randomStart: false
            });
        }
    },
    blogInit: function () {
        // insta photos
        $('#instagram-photos').embedagram({
            instagram_id: 14985997,
            thumb_width: 70,
            limit: 20,
            success: function () { $('#instagram-photos').bxSlider({displaySlideQty: 2, moveSlideQty: 2, prevSelector: '#insta-prev', nextSelector: '#insta-next', auto: true, pause: 6000, autoHover: true}); }
        });
        // CATEGORY TREE VIEW ON BLOG PAGES
        $(".widget_mycategoryorder ul").treeview({
            persist: "location",
            collapsed: true,
            unique: false,
            animated: "fast"
        });
    },
    blogSingleInit: function () {
        // give any link with 'lighbox' class a lightbox
        $('a.lightbox').colorbox({rel: 'blogGallery', opacity: 1});
        // give any auto gallery a lightbox
        $('.gallery a').colorbox({rel: 'blogGallery', opacity: 1});
    },
    storeLocatorInit: function () {
        var self = this;
        $('.dealer-link').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            self.utilities.pageScroll(url);
        });
    },
    shoppingCartInit: function () {
        var self, lang, regionCookie;
        self = this;
        /*
        shopatron.getCart({
            template: 'default'
        }, {
            view: 'html',
            location: 'shopping-cart',
            success: function (data, textStatus) {},
            error: function (textStatus, errorThrown) {},
            complete: function (textStatus) {}
        });
        */
        Shopatron('#shopping-cart').getCart({
            imageWidth: 100,
            imageHeight: 100
        },{
            success: function(cartData) {},
            error: function() {},
            complete: function() {}
        });
        // check for the region
        regionCookie = self.utilities.cookie.getCookie('GNURegion');
        if (regionCookie != null || regionCookie != "") {
            lang = regionCookie;
        } else {
            lang = 'us';
        }
        // update links on page
        if (lang === 'ca') {
            $("a.link-ordering-info").prop("href", "http://gnu-ca.shptron.com/home/ordering/4374.7.1.2");
            $("a.link-return-policy").prop("href", "http://gnu-ca.shptron.com/home/policies/4374.7.1.2#Returns");
        } else {
            $("a.link-ordering-info").prop("href", "http://gnu.shptron.com/home/ordering/4374.6.1.1");
            $("a.link-return-policy").prop("href", "http://gnu.shptron.com/home/policies/4374.6.1.1#Returns");
        }
        // region selector trigger
        $('.link-region-selector').click(function (e) {
            e.preventDefault();
            self.regionSelectorOverlayInit();
        });
    },
    quickCartInit: function () {
        /*
        shopatron.getQuickCart({
            cartLink: '/shopping-cart/'
        }, {
            view: 'json',
            success: function (data, textStatus) {
                var itemsInCart = 0;
                // find quantity of items in cart
                $.each(data.cartItems, function (key, value) {
                    itemsInCart += parseInt(value.quantity);
                });
                $('#quick-cart a span').html(itemsInCart);
            },
            error: function (textStatus, errorThrown) {},
            complete: function (textStatus) {}
        });
        */
        Shopatron.getCart({
            success: function (data, textStatus) {
                var itemsInCart = 0;
                // find quantity of items in cart
                $.each(data.cartItems, function (key, value) {
                    itemsInCart += parseInt(value.quantity);
                });
                $('#quick-cart a span').html(itemsInCart);
            },
        });
    },
    utilities: {
        cookie: {
            getCookie: function (name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i=0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return null;
            },
            setCookie: function (name, value, days) {
                var date, expires;
                if (days) {
                    date = new Date();
                    date.setTime(date.getTime()+(days*24*60*60*1000));
                    expires = "; expires="+date.toGMTString();
                } else {
                    expires = "";
                }
                document.cookie = name + "=" + value + expires + "; path=/";
            }
        },
        pageScroll: function (hash) {
            // Smooth Page Scrolling, update hash on complete of animation
            $('html,body').animate({scrollTop: $(hash).offset().top},'slow', function () { window.location = hash; });
        }
    }
};