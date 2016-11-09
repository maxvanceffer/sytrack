/**
 * Created by dev06 on 09.11.2016.
 */
(function () {
    "use strict";
    window.APP = window.APP || {};

    APP.Application = Backbone.Marionette.Application.extend({
        region: '#issues-region',

        onStart: function () {
            this.showView(new APP.IssueView());
        }
    });

    var app = new APP.Application();

    app.start();
}());
