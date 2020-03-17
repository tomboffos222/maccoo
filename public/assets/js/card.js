/*
 * jQuery myCart - v1.7 - 2018-03-07
 * http://asraf-uddin-ahmed.github.io/
 * Copyright (c) 2017 Asraf Uddin Ahmed; Licensed None
 */

(function ($) {

    "use strict";

    var OptionManager = (function () {
        var objToReturn = {};

        var _options = null;
        var DEFAULT_OPTIONS = {
            currencySymbol: 'Т',
            classCartIcon: 'my-cart-icon',
            classCartBadge: 'my-cart-badge',
            classProductQuantity: 'my-product-quantity',
            classProductRemove: 'my-product-remove',
            classCheckoutCart: 'my-cart-checkout',
            affixCartIcon: true,
            showCheckoutModal: true,
            numberOfDecimals: 2,
            cartItems: null,
            clickOnAddToCart: function ($addTocart) {},
            afterAddOnCart: function (products, totalPrice, totalQuantity) {},
            clickOnCartIcon: function ($cartIcon, products, totalPrice, totalQuantity) {},
            checkoutCart: function (products, totalPrice, totalQuantity) {
                return false;
            },
            getDiscountPrice: function (products, totalPrice, totalQuantity) {
                return null;
            }
        };


        var loadOptions = function (customOptions) {
            _options = $.extend({}, DEFAULT_OPTIONS);
            if (typeof customOptions === 'object') {
                $.extend(_options, customOptions);
            }
        };
        var getOptions = function () {
            return _options;
        };

        objToReturn.loadOptions = loadOptions;
        objToReturn.getOptions = getOptions;
        return objToReturn;
    }());

    var MathHelper = (function () {
        var objToReturn = {};
        var getRoundedNumber = function (number) {
            if (isNaN(number)) {
                throw new Error('Parameter is not a Number');
            }
            number = number * 1;
            var options = OptionManager.getOptions();
            return number.toFixed(options.numberOfDecimals);
        };
        objToReturn.getRoundedNumber = getRoundedNumber;
        return objToReturn;
    }());

    var ProductManager = (function () {
        var objToReturn = {};

        /*
        PRIVATE
        */
        localStorage.products = localStorage.products ? localStorage.products : "";
        var getIndexOfProduct = function (id) {
            var productIndex = -1;
            var products = getAllProducts();
            $.each(products, function (index, value) {
                if (value.id == id) {
                    productIndex = index;
                    return;
                }
            });
            return productIndex;
        };
        var setAllProducts = function (products) {
            localStorage.products = JSON.stringify(products);
        };
        var addProduct = function (id, name, summary, price, quantity, image, option, option_id, option_group) {
            var products = getAllProducts();
            products.push({
                id: id,
                name: name,
                summary: summary,
                price: price,
                quantity: quantity,
                image: image,
                option: option,
                option_id: option_id,
                option_group: option_group
            });
            setAllProducts(products);
        };

        /*
        PUBLIC
        */
        var getAllProducts = function () {
            try {
                var products = JSON.parse(localStorage.products);
                return products;
            } catch (e) {
                return [];
            }
        };
        var updatePoduct = function (id, quantity) {
            var productIndex = getIndexOfProduct(id);
            if (productIndex < 0) {
                return false;
            }
            var products = getAllProducts();
            products[productIndex].quantity = typeof quantity === "undefined" ? products[productIndex].quantity * 1 + 1 : quantity;
            setAllProducts(products);
            return true;
        };
        var setProduct = function (id, name, summary, price, quantity, image, option, option_id, option_group) {
            if (typeof id === "undefined") {
                console.error("id required");
                return false;
            }
            if (typeof name === "undefined") {
                console.error("name required");
                return false;
            }
            if (typeof image === "undefined") {
                console.error("image required");
                return false;
            }
            if (!$.isNumeric(price)) {
                console.error("price is not a number");
                return false;
            }
            if (!$.isNumeric(quantity)) {
                console.error("quantity is not a number");
                return false;
            }
            summary = typeof summary === "undefined" ? "" : summary;

            option = typeof option === "undefined" ? "" : option;
            option_id = typeof option_id === "undefined" ? "" : option_id;
            option_group = typeof option_group === "undefined" ? "" : option_group;

            if (!updatePoduct(id)) {
                addProduct(id, name, summary, price, quantity, image, option, option_id, option_group);
            }
        };
        var clearProduct = function () {
            setAllProducts([]);
        };
        var removeProduct = function (id) {
            var products = getAllProducts();
            products = $.grep(products, function (value, index) {
                return value.id != id;
            });
            setAllProducts(products);
        };
        var getTotalQuantity = function () {
            var total = 0;
            var products = getAllProducts();
            $.each(products, function (index, value) {
                total += value.quantity * 1;
            });
            return total;
        };
        var getTotalPrice = function () {
            var products = getAllProducts();
            var total = 0;
            $.each(products, function (index, value) {
                total += value.quantity * value.price;
                total = MathHelper.getRoundedNumber(total) * 1;
            });
            return total;
        };

        objToReturn.getAllProducts = getAllProducts;
        objToReturn.updatePoduct = updatePoduct;
        objToReturn.setProduct = setProduct;
        objToReturn.clearProduct = clearProduct;
        objToReturn.removeProduct = removeProduct;
        objToReturn.getTotalQuantity = getTotalQuantity;
        objToReturn.getTotalPrice = getTotalPrice;
        return objToReturn;
    }());


    var loadMyCartEvent = function (targetSelector) {

        var options = OptionManager.getOptions();
        var $cartIcon = $("." + options.classCartIcon);
        var $cartBadge = $("." + options.classCartBadge);
        var classProductQuantity = options.classProductQuantity;
        var classProductRemove = options.classProductRemove;
        var classCheckoutCart = options.classCheckoutCart;

        var idCartModal = 'my-cart-modal';
        var idCartTable = 'my-cart-table';
        var idGrandTotal = 'my-cart-grand-total';
        var idEmptyCartMessage = 'my-cart-empty-message';
        var idDiscountPrice = 'my-cart-discount-price';
        var classProductTotal = 'my-product-total';
        var classAffixMyCartIcon = 'my-cart-icon-affix';


        if (options.cartItems && options.cartItems.constructor === Array) {
            ProductManager.clearProduct();
            $.each(options.cartItems, function () {
                ProductManager.setProduct(this.id, this.name, this.summary, this.price, this.quantity, this.image, this.option, this.option_id, this.option_group);
            });
        }

        $cartBadge.text(ProductManager.getTotalQuantity());

        if (!$("#" + idCartModal).length) {
            $('body').append(
                '<div class="modal fade" id="' + idCartModal + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">' +
                '<div class="modal-dialog" role="document">' +
                '<div class="modal-content">' +
                '<form action="/test" method="get">'+
                '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-shopping-cart"></span>Корзина</h4>' +
                '</div>' +
                '<div class="modal-body">' +
                '<table class="table table-hover table-responsive" id="' + idCartTable + '"></table>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>' +
                '<input type="submit" class="btn btn-primary ' + classCheckoutCart + '">' +
                '</div>' +
                '</form>'+
                '</div>' +
                '</div>' +
                '</div>'
            );
        }

        var drawTable = function () {
            var $cartTable = $("#" + idCartTable);
            $cartTable.empty();

            var products = ProductManager.getAllProducts();
            $.each(products, function () {
                var total = this.quantity * this.price;
                $cartTable.append(

                    '<tr title="' + this.summary + '"data-option_group="'+  this.option_group +'" data-option_id="' + this.option_id + '" data-id="' + this.id + '" data-price="' + this.price + '">' +

                    '<td class="text-center" style="width: 30px;"><img width="30px" height="30px" src="' + this.image + '"/></td>' +
                    '<input type="hidden" name="product_ids[]" value="' + this.id + '">' +
                    '<input type="hidden" name="quantity[]" value="' + this.quantity + '">' +
                    '<td>' + this.name + ' ' + this.option_group + ' ' + this.option + '</td>' +

                    '<td title="Unit Price" class="text-right">' + MathHelper.getRoundedNumber(this.price) + '&nbsp;' + 'KZT' + '</td>' +
                    '<td title="Quantity"><input type="number" min="1" style="width: 40px;" class="' + classProductQuantity + '" value="' + this.quantity + '"/></td>' +
                    '<td title="Total" class="text-right ' + classProductTotal + '">' + MathHelper.getRoundedNumber(total) + '&nbsp;' + 'KZT' + '</td>' +
                    '<td title="Remove from Cart" class="text-center" style="width: 30px;"><a href="javascript:void(0);" class="btn btn-xs btn-danger ' + classProductRemove + '">X</a></td>' +
                    '</input>'
                );
            });

            $cartTable.append(products.length ?
                '<tr>' +
                '<td></td>' +

                '<td><strong>Итого</strong></td>' +
                '<td></td>' +
                '<td></td>' +
                '<input type="hidden" name="total" value="">'+
                '<td class="text-right"><strong id="' + idGrandTotal + '"></strong></td>' +
                '<td></td>' +
                '</tr>' :
                '<div class="alert alert-danger" role="alert" id="' + idEmptyCartMessage + '">Ваша корзина пуста</div>'
            );

            var discountPrice = options.getDiscountPrice(products, ProductManager.getTotalPrice(), ProductManager.getTotalQuantity());
            if (products.length && discountPrice !== null) {
                $cartTable.append(
                    '<tr style="color: red">' +
                    '<td></td>' +
                    '<td><strong>Total (including discount)</strong></td>' +
                    '<td></td>' +
                    '<td></td>' +
                    '<td class="text-right"><strong id="' + idDiscountPrice + '"></strong></td>' +

                    '<td></td>' +
                    '</tr>'
                );
            }

            showGrandTotal();

            showDiscountPrice();
        };
        var showModal = function () {
            drawTable();
            $("#" + idCartModal).modal('show');
        };
        var updateCart = function () {
            $.each($("." + classProductQuantity), function () {
                var id = $(this).closest("tr").data("id");
                ProductManager.updatePoduct(id, $(this).val());
            });
        };
        var showGrandTotal = function () {
            $("#" + idGrandTotal).text(MathHelper.getRoundedNumber(ProductManager.getTotalPrice()) + ' ' +options.currencySymbol);
        };
        var showDiscountPrice = function () {
            $("#" + idDiscountPrice).text(MathHelper.getRoundedNumber(options.getDiscountPrice(ProductManager.getAllProducts(), ProductManager.getTotalPrice(), ProductManager.getTotalQuantity())) + ' '+ options.currencySymbol);
        };

        /*
        EVENT
        */
        if (options.affixCartIcon) {
            var cartIconBottom = $cartIcon.offset().top * 1 + $cartIcon.css("height").match(/\d+/) * 1;
            var cartIconPosition = $cartIcon.css('position');
            $(window).scroll(function () {
                $(window).scrollTop() >= cartIconBottom ? $cartIcon.addClass(classAffixMyCartIcon) : $cartIcon.removeClass(classAffixMyCartIcon);
            });
        }

        $cartIcon.click(function () {
            options.showCheckoutModal ? showModal() : options.clickOnCartIcon($cartIcon, ProductManager.getAllProducts(), ProductManager.getTotalPrice(), ProductManager.getTotalQuantity());
        });

        $(document).on("input", "." + classProductQuantity, function () {
            var price = $(this).closest("tr").data("price");
            var id = $(this).closest("tr").data("id");
            var quantity = $(this).val();

            $(this).parent("td").next("." + classProductTotal).text(options.currencySymbol + MathHelper.getRoundedNumber(price * quantity));
            ProductManager.updatePoduct(id, quantity);

            $cartBadge.text(ProductManager.getTotalQuantity());
            showGrandTotal();
            showDiscountPrice();
        });

        $(document).on('keypress', "." + classProductQuantity, function (evt) {
            if (evt.keyCode == 38 || evt.keyCode == 40) {
                return;
            }
            evt.preventDefault();
        });

        $(document).on('click', "." + classProductRemove, function () {
            var $tr = $(this).closest("tr");
            var id = $tr.data("id");
            $tr.hide(500, function () {
                ProductManager.removeProduct(id);
                drawTable();
                $cartBadge.text(ProductManager.getTotalQuantity());
            });
        });

        $(document).on('click', "." + classCheckoutCart, function () {
            var products = ProductManager.getAllProducts();
            if (!products.length) {
                $("#" + idEmptyCartMessage).fadeTo('fast', 0.5).fadeTo('fast', 1.0);
                return;
            }
            updateCart();
            var isCheckedOut = options.checkoutCart(ProductManager.getAllProducts(), ProductManager.getTotalPrice(), ProductManager.getTotalQuantity());
            if (isCheckedOut !== false) {
                ProductManager.clearProduct();
                $cartBadge.text(ProductManager.getTotalQuantity());
                $("#" + idCartModal).modal("hide");
            }
        });

        $(document).on('click', targetSelector, function () {
            var $target = $(this);
            options.clickOnAddToCart($target);

            var id = $target.data('id');
            var name = $target.data('name');
            var summary = $target.data('summary');
            var price = $target.data('price');
            var quantity = $target.data('quantity');
            var image = $target.data('image');
            var option = $target.data('option');
            var option_id = $target.data('option_id');
            var option_group = $target.data('option_group');

            ProductManager.setProduct(id, name, summary, price, quantity, image, option, option_id, option_group);
            $cartBadge.text(ProductManager.getTotalQuantity());

            options.afterAddOnCart(ProductManager.getAllProducts(), ProductManager.getTotalPrice(), ProductManager.getTotalQuantity());
        });

    };


    $.fn.myCart = function (userOptions) {
        OptionManager.loadOptions(userOptions);
        loadMyCartEvent(this.selector);
        return this;
    };


})(jQuery);

$(document).ready(function() {

    var goToCartIcon = function($addTocartBtn){
        var $cartIcon = $(".my-cart-icon");
        var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
        $addTocartBtn.prepend($image);
        var position = $cartIcon.position();
        $image.animate({
            top: position.top,
            left: position.left
        }, 500 , "linear", function() {
            $image.remove();
        });
    }

    $('.my-cart-btn').myCart({
        classCartIcon: 'my-cart-icon',
        classCartBadge: 'my-cart-badge',
        affixCartIcon: true,
        currencySymbol:'KZT',
        numberOfDecimals: 0,
        checkoutCart: function(products) {
//      var p = []
//      $.each(products, function(){
//        console.log(this);
//      });
//      console.log($('input[name=csrfmiddlewaretoken]').val())
            data = {'csrfmiddlewaretoken': $('input[name=csrfmiddlewaretoken]').val(), 'products': JSON.stringify(products)}
            $.redirect('/catalog/order/', data, 'POST');
        },
        clickOnAddToCart: function($addTocart){
            goToCartIcon($addTocart);
        },
        getDiscountPrice: function(products) {
            return null;
            var total = 0;
            $.each(products, function(){
                total += this.quantity * this.price;
            });
            return total * 0.5;
        }
    });

    $('.product-options').change(function(){
        var $to_cart_btn= $(this).parent().parent().find('.my-cart-btn'),
            option_title =  $(this).find('option:selected').text(),
            id = $to_cart_btn.data('id_real'),
            option_id = $(this).val(),
            new_id = id + '_' + option_id;
        $to_cart_btn.data('id', new_id);
        $to_cart_btn.data('option_id', option_id);
        $to_cart_btn.data('option', option_title);
    });

});
