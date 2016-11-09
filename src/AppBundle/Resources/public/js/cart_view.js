/**
 * Created by dev06 on 09.11.2016.
 */
(function () {
    "use strict";
    window.APP = window.APP || {};

    APP.ItemView = Backbone.Marionette.View.extend({
        template: '#cart-item-view',
        ui: {

        },
        events: {

        },
        modelEvents: {

        }
    })

    APP.CartView = Backbone.Marionette.CompositeView.extend({
        template: '#cart-view',
        tagName: 'div',
        className: 'container text-center',
        childViewContainer: '.items',
        ui: {

        },
    })
}());
