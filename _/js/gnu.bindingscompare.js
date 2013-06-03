/*

    GNU - gnu.com - binding comparison tool
    VERSION 1.0
    AUTHOR brian.behrens@mervin.com

    DEPENDENCIES:
    - jQuery v1.8.0
    - GNU.main v1.0

*/

var GNU = GNU || {};

GNU.BindingsCompare = {
    config: {
        bindingArray: []
    },
    init: function () {
        var self = this;
        // add listener to change event of compare checkboxes
        $('.compare input:checkbox').change(function(){
            if ($(this).is(':checked')) {
                var compareID, compareContainer, compareImage, compareName;
                // get binding values
                compareID = $(this).val();
                compareContainer = '#compare-' + $(this).val();
                compareImage = $(compareContainer + ' input[name="product-image"]').val();
                compareName = $(compareContainer + ' input[name="product-name"]').val();
                // add binding to list
                self.addBinding(compareID, compareImage, compareName);
            } else {
                // box was unchecked, so remove the binding by id
                var compareID = $(this).val();
                self.removeBinding(compareID);
            }
        });
        // add listeners to click event of compare list items to remove them
        $('.binding-compare ul li').click(function(){
            // get array index of clicked binding
            var index = $('.binding-compare ul li').index(this);
            // make sure there is something to remove
            if (index < self.config.bindingArray.length) {
                // uncheck checkbox for removed binding
                $('#checkbox-' + self.config.bindingArray[index].id).attr('checked', false);
                // remove item from array
                self.config.bindingArray.splice(index, 1);
                // update cookie
                self.updateCookie();
                // update view
                self.updateView();
            }
        });
        // read cookie on init
        if (navigator.cookieEnabled === true) {
            var bindingCookie = GNU.main.utilities.cookie.getCookie('GNUBindings');
            // make sure the cookie has IDs stored
            if (bindingCookie != null && bindingCookie != "") {
                var bindingIDArray = bindingCookie.split(',');
                // check the bindings based on id
                for (var i = 0; i < bindingIDArray.length; i++) {
                    var bindingID, bindingContainer, bindingImage, bindingName;
                    // get binding values
                    bindingID = bindingIDArray[i];
                    bindingContainer = '#compare-' + bindingID;
                    bindingImage = $(bindingContainer + ' input[name="product-image"]').val();
                    bindingName = $(bindingContainer + ' input[name="product-name"]').val();
                    // set correct checkboxes, don't use click because the listener above will fire again
                    $('#checkbox-' + bindingID).prop('checked', true);
                    // add binding to list
                    self.addBinding(bindingID, bindingImage, bindingName);
                }
            }
        }
    },
    addBinding: function (bindingID, bindingImage, bindingName) {
        var self, binding;
        self = this;
        binding = {};
        binding.id = bindingID;
        binding.image = bindingImage;
        binding.name = bindingName;
        // check if 3 items already exist in binding array
        if(self.config.bindingArray.length > 2){
            // uncheck the first binding that was added
            $('#checkbox-' + self.config.bindingArray[0].id).attr('checked', false);
            // remove first item so there's room for a new one
            self.config.bindingArray.splice(0, 1);
        }
        // add binding to array
        self.config.bindingArray.push(binding);
        // update cookie
        self.updateCookie();
        // update view
        self.updateView();
        // scroll the page to show the comparison area when more than 1 binding is added
        if (self.config.bindingArray.length > 1) {
            GNU.main.utilities.pageScroll("#binding-comparison");
        }
    },
    removeBinding: function (bindingID) {
        var self = this;
        // remove binding from stored array of selected bindings
        for (var i = 0; i < self.config.bindingArray.length; i++) {
            var binding = self.config.bindingArray[i];
            if(binding.id == bindingID) {
                self.config.bindingArray.splice(i, 1);
            }
        }
        // update cookie
        self.updateCookie();
        // update view
        self.updateView();
    },
    updateCookie: function () {
        var self, bindingIDs;
        self = this;
        bindingIDs = "";
        // set up string of binding ids
        for (var i = 0; i<self.config.bindingArray.length; i++) {
            bindingIDs += self.config.bindingArray[i].id;
            if (i+1 != self.config.bindingArray.length) {
                bindingIDs += ",";
            }
        }
        // check if cookies are available
        if (navigator.cookieEnabled === true) {
            // update cookie with string of binding ids
            GNU.main.utilities.cookie.setCookie('GNUBindings', bindingIDs, 7);
        } else {
            alert('Enable cookies in your browser in order to compare bindings.');
        }
    },
    updateView: function () {
        var self = this;
        // add new binding images to list/view
        for (var i = 0; i < self.config.bindingArray.length; i++) {
            var binding = self.config.bindingArray[i];
            var listItem = $('.binding-compare ul li')[i];
            $(listItem).children('img').attr("src", binding.image);
            $(listItem).children('span').text(binding.name);
            $(listItem).addClass('active');
        }
        // remove old images
        for (var i = 3; i>self.config.bindingArray.length; i--) {
            var listItem = $('.binding-compare ul li')[i-1];
            $(listItem).children('img').attr("src", '/wp-content/themes/gnu_3/_/img/binding-compare-blank.png');
            $(listItem).children('span').text("");
            $(listItem).removeClass('active');
        }
    }
};