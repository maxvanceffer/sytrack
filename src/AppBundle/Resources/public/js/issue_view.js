/**
 * Created by dev06 on 09.11.2016.
 */
(function () {
    "use strict";
    window.APP = window.APP || {};

    APP.IssueView = Backbone.Marionette.View.extend({
        region: '#issues-region',
        onRender: function () {
            this.issues = new APP.IssuesCollection();

            this.backgrid = new new Backgrid.Grid({
                columns: columns,
                collection: this.issues
            });

            this.showView(this.backgrid);

            this.issues.fetch();
        }
    });
}());
