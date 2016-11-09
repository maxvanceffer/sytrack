/**
 * Created by dev06 on 09.11.2016.
 */
(function () {
    "use strict";
    window.APP = window.APP || {};

    APP.IssuesCollection = Backbone.PageableCollection.extend({

        url: "/admin/issue",

        // Initial pagination states
        state: {
            pageSize: 15,
            sortKey: "updated",
            order: 1
        },

        // You can remap the query parameters from `state` keys from
        // the default to those your server supports
        queryParams: {
            totalPages: null,
            totalRecords: null,
            sortKey: "sort"
        },

        parseState: function (resp, queryParams, state, options) {
            return {totalRecords: resp.total_count};
        },

        parseRecords: function (resp, options) {
            return resp.items;
        }

    });
}());
