! function(t) {
    var r = {};

    function n(e) {
        if (r[e]) return r[e].exports;
        var u = r[e] = {
            i: e,
            l: !1,
            exports: {}
        };
        return t[e].call(u.exports, u, u.exports, n), u.l = !0, u.exports
    }
    n.m = t, n.c = r, n.d = function(t, r, e) {
        n.o(t, r) || Object.defineProperty(t, r, {
            configurable: !1,
            enumerable: !0,
            get: e
        })
    }, n.n = function(t) {
        var r = t && t.__esModule ? function() {
            return t.default
        } : function() {
            return t
        };
        return n.d(r, "a", r), r
    }, n.o = function(t, r) {
        return Object.prototype.hasOwnProperty.call(t, r)
    }, n.p = "/", n(n.s = 260)
}({
    260: function(t, r, n) {
        t.exports = n(261)
    },
    261: function(t, r) {
        $("#order-status").change(function(t) {
            $.ajax({
                type: "PUT",
                url: route("admin.orders.status.update", t.currentTarget.dataset.id),
                data: {
                    status: t.currentTarget.value
                },
                success: function(t) {
                    function r(r) {
                        return t.apply(this, arguments)
                    }
                    return r.toString = function() {
                        return t.toString()
                    }, r
                }(function(t) {
                    success(t)
                }),
                error: function(t) {
                    function r(r) {
                        return t.apply(this, arguments)
                    }
                    return r.toString = function() {
                        return t.toString()
                    }, r
                }(function(t) {
                    error(t.statusText + ": " + t.responseJSON.message)
                })
            })
        });
    }
});
