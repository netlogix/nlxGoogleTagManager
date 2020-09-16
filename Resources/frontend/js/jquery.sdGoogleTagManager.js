(function($, window) {
    $.plugin('nlxGoogleTagManager', {
        defaults: {
            'productClickSelector': '*[data-gtm-productClick="true"]',

            'removeFromCartClickSelector': '*[data-gtm-removeFromCartClick="true"]',

            'addVoucherClickSelector': '#add-voucher--trigger',

            'billingShippingClickSelector': '#register_billing_shippingAddress',

            'googleClickTriggered': false,

            'resetDocumentLocation': true,

            'googleAnalyticsOptoutLinkSelector': '*[data-ga-optout="true"]'
        },

        init: function () {
            var me = this;

            me._on(me.opts.googleAnalyticsOptoutLinkSelector, 'click', $.proxy(me.googleAnalyticsOptout, me));
            if (window.nlxGoogleTagManagerTrackingActive) {
                me.applyDataAttributes();

                me.$productClick = $(me.opts.productClickSelector);
                me._on(me.$productClick, 'click', $.proxy(me._onProductClick, me));

                me.$removeFromCartClick = $(me.opts.removeFromCartClickSelector);
                me._on(me.$removeFromCartClick, 'click', $.proxy(me._onRemoveFromCartClick, me));

                me.$addVoucherTrigger = $(me.opts.addVoucherClickSelector);
                me._on(me.$addVoucherTrigger, 'change', $.proxy(me._onChangeVoucherTrigger, me));

                me.$registerBillingShippingAddres = $(me.opts.billingShippingClickSelector);
                me._on(me.$addVoucherTrigger, 'change', $.proxy(me._onChangeBillingShippingAddress, me));

                // Click on 'edit' payment step
                $.subscribe('plugin/sdOnePageCheckout/onClickEditStep', function (event, plugin) {
                    var currentStep = plugin.currentStepNumber;
                    me.pushCheckoutStepToGoogle(currentStep);
                });

                // Click on 'next' payment step
                $.subscribe('plugin/sdOnePageCheckout/onFinishedAjaxSuccess', function (event, plugin) {
                    var currentStep = plugin.currentStepNumber;
                    me.pushCheckoutStepToGoogle(currentStep);
                });

                $.subscribe('plugin/swInfiniteScrolling/onFetchNewPageFinished', function () {
                    me.$productClick = $(me.opts.productClickSelector);
                    me._on(me.$productClick, 'click', $.proxy(me._onProductClick, me));
                });

                $.subscribe('plugin/sdZipSearch/onShippable', function (e, plugin, isShippable) {
                    // shippable
                    me.pushToGoogle({
                        'event': 'productAvailable',
                        'value': isShippable
                    });
                });
            }
        },

        _onProductClick: function (e) {
            var me = this,
                $target = $(e.currentTarget);

            e.stopPropagation();
            e.preventDefault();

            var obj = {
                'event': 'productClick',
                'ecommerce': {
                    'click': {
                        'products': [{
                            'name': $target.data('gtm-name'),
                            'id': $target.data('gtm-id'),
                            'price': $target.data('gtm-price'),
                            'brand': $target.data('gtm-brand'),
                            'category': $target.data('gtm-cat'),
                            'position': $target.data('gtm-position')
                        }]
                    }
                },
                'eventCallback': function() {
                    if (me.opts.resetDocumentLocation) {
                        document.location = $target.attr('href');
                    }
                }
            };

            $.publish('plugin/nlxGoogleTagManager/onProductClick', [ me ]);

            me.pushToGoogle(obj);
        },

        _onRemoveFromCartClick: function (e) {
            var me = this;

            e.stopPropagation();
            e.preventDefault();

            var obj = {
                'event': 'removeFromCart',
                'ecommerce': {
                    'remove': {
                        'products': [{
                            'name': me.opts['gtm-name'],
                            'id': me.opts['gtm-id'],
                            'price': me.opts['gtm-price'],
                            'brand': me.opts['gtm-brand'],
                            'quantity': me.opts['gtm-quantity']
                        }]
                    }
                },
                'eventCallback': function() {
                    $(e.currentTarget).closest('form').submit();
                }
            };

            $.publish('plugin/nlxGoogleTagManager/onRemoveFromCartClick', [ me ]);

            if (me.opts.googleClickTriggered === false) {
                me.opts.googleClickTriggered = true;
                me.pushToGoogle(obj);
            }
        },

        _onChangeVoucherTrigger: function (e) {
            var me = this;

            if (e.currentTarget.checked) {
                me.pushToGoogle({
                    'event': 'voucherButton'
                });
            }
        },

        _onChangeBillingShippingAddress: function (e) {
            var me = this;

            if (e.currentTarget.checked) {
                me.pushToGoogle({
                    'event': 'shippingButton'
                });
            }
        },

        /**
         * Pushes the dataLayer to google
         * @param obj
         */
        pushToGoogle: function (obj) {
            if (!window.dataLayer) {
                console.error('dataLayer not defined for tracking');
                return;
            }

            window.dataLayer.push(obj);
        },

        pushCheckoutStepToGoogle: function (currentStep) {
            var me = this;

            me.pushToGoogle({
                'event': 'checkout',
                'ecommerce': {
                    'checkout': {
                        'actionField': {
                            'step': currentStep.toString()
                        },
                        'currencyCode': 'EUR',
                        'products': window.globalBasketProducts
                    }
                }
            });
        },

        googleAnalyticsOptout: function () {
            for (var id of Object.keys(window.gaData)) {
                Cookies.set(`ga-disable-${id}`, true, { expires: new Date(3000, 1, 1) });
            }
            alert(window.nlxGTMSnippets.googleAnalyticsOptoutSuccess);
        }
    });

    $(function() {
        window.StateManager.addPlugin('body', 'nlxGoogleTagManager');
    });
})(jQuery, window);
