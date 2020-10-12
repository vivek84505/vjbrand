
    ! function(e) {
        var i = {
            logo_align: "left",
            links_align: "left",
            socialBar_align: "left",
            searchBar_align: "right",
            trigger: "hover",
            effect: "fade",
            effect_speed: 400,
            sibling: !0,
            outside_click_close: !0,
            top_fixed: !1,
            sticky_header: !1,
            sticky_header_height: 200,
            menu_position: "horizontal",
            mobile_settings: {
                collapse: !0,
                sibling: !0,
                scrollBar: !0,
                scrollBar_height: 400,
                top_fixed: !1,
                sticky_header: !1,
                sticky_header_height: 200
            }
        };
        e.fn.megaMenu = function(t) {
            return t = e.extend({}, i, t || {}), this.each(function() {
                var i, s = e(this),
                    a = "ul",
                    n = "li",
                    l = "a",
                    r = s.find(".menu-logo"),
                    o = r.children(n),
                    f = s.find(".menu-links"),
                    c = f.children(n),
                    d = s.find(".menu-social-bar"),
                    g = s.find(".menu-search-bar"),
                    p = ".menu-mobile-collapse-trigger",
                    _ = ".mobileTriggerButton",
                    h = ".desktopTriggerButton",
                    m = "active",
                    u = "activeTrigger",
                    v = "activeTriggerMobile",
                    b = ".drop-down-multilevel, .drop-down, .drop-down-tab-bar",
                    C = "desktopTopFixed",
                    k = "mobileTopFixed";
                i = {
                    logo_Align: function() {
                        "right" === t.logo_align ? r.addClass("menu-logo-align-right") : r.removeClass("menu-logo-align-right")
                    },
                    links_Align: function() {
                        "right" === t.links_align ? f.addClass("menu-links-align-right") : f.removeClass("menu-links-align-right")
                    },
                    social_bar_Align: function() {
                        "right" === t.socialBar_align ? d.addClass("menu-social-bar-right") : d.removeClass("menu-social-bar-right")
                    },
                    search_bar_Align: function() {
                        "left" === t.searchBar_align ? g.addClass("menu-search-bar-left") : g.removeClass("menu-search-bar-left")
                    },
                    collapse_trigger_button: function() {
                        if (t.mobile_settings.collapse === !0) {
                            o.append('<div class="menu-mobile-collapse-trigger"><span></span></div>');
                            var i = f.add(d);
                            i.hide(0), g.addClass(m), s.find(p).on("click", function() {
                                return i.is(":hidden") ? (e(this).addClass(m), i.show(0)) : (e(this).removeClass(m), i.hide(0)), !1
                            })
                        }
                    },
                    switch_effects: function() {
                        switch (t.effect) {
                            case "fade":
                                s.find(b).removeClass("effect-scale effect-expand-top effect-expand-bottom effect-expand-left effect-expand-right").addClass("effect-fade");
                                break;
                            case "scale":
                                s.find(b).removeClass("effect-fade effect-expand-top effect-expand-bottom effect-expand-left effect-expand-right").addClass("effect-scale");
                                break;
                            case "expand-top":
                                s.find(b).removeClass("effect-scale effect-fade effect-expand-bottom effect-expand-left effect-expand-right").addClass("effect-expand-top");
                                break;
                            case "expand-bottom":
                                s.find(b).removeClass("effect-scale effect-expand-top effect-fade effect-expand-left effect-expand-right").addClass("effect-expand-bottom");
                                break;
                            case "expand-left":
                                s.find(b).removeClass("effect-scale effect-expand-top effect-expand-bottom effect-fade effect-expand-right").addClass("effect-expand-left");
                                break;
                            case "expand-right":
                                s.find(b).removeClass("effect-scale effect-expand-top effect-expand-bottom effect-expand-left effect-fade").addClass("effect-expand-right")
                        }
                    },
                    transition_delay: function() {
                        s.find(b).css({
                            webkitTransition: "all " + t.effect_speed + "ms ease ",
                            transition: "all " + t.effect_speed + "ms ease "
                        })
                    },
                    hover_trigger: function() {
                        "hover" === t.trigger && (i.transition_delay(), s.find(b).parents(n).removeClass("ClickTrigger activeTrigger"), s.find(b).parents(n).addClass("hoverTrigger"), s.find(".desktopTriggerButton").detach(), i.switch_effects())
                    },
                    mobile_trigger: function() {
                        s.find(b).prev(l).append('<div class="mobileTriggerButton"></div>'), s.find(_).on("click", function() {
                            var i = e(this),
                                r = i.parents(l),
                                o = r.next(b);
                            return o.is(":hidden") ? (t.mobile_settings.sibling === !0 && (i.parents(s).siblings(a + "," + n).find(b).hide(0), i.parents(s).siblings(n).removeClass(v), i.parents(s).siblings(a).find(n).removeClass(v)), r.parent(n).addClass(v), o.show(0)) : (r.parent(n).removeClass(v), o.hide(0)), !1
                        }), s.find("i.fa.fa-indicator").on("click", function() {
                            return !1
                        })
                    },
                    click_trigger: function() {
                        "click" === t.trigger && (s.find(b).parents(n).removeClass("hoverTrigger"), s.find(b).prev(l).append('<div class="desktopTriggerButton"></div>'), s.find(b).parents(n).addClass("ClickTrigger"), i.switch_effects(), i.transition_delay(), s.find(h).on("click", function() {
                            var i = e(this),
                                r = i.parents(l),
                                o = r.next(b);
                            return o.hasClass(m) ? (r.parent(n).removeClass(u), o.removeClass(m)) : (t.sibling === !0 && (i.parents(s).siblings(a + "," + n).find(b).removeClass(m), i.parents(s).siblings(n).removeClass(u), i.parents(s).siblings(a).find(n).removeClass(u)), r.parent(n).addClass(u), o.addClass(m)), !1
                        }))
                    },
                    outside_close: function() {
                        t.outside_click_close === !0 && "click" === t.trigger && s.find(b).is(":visible") ? e(document).off("click").on("click", function(e) {
                            s.is(e.target) || 0 !== s.has(e.target).length || (s.find(b).removeClass(m), c.removeClass("activeTrigger"))
                        }) : e(document).off("click")
                    },
                    scroll_bar: function() {
                        t.mobile_settings.scrollBar === !0 && f.css({
                            maxHeight: t.mobile_settings.scrollBar_height + "px",
                            overflow: "auto"
                        })
                    },
                    top_Fixed: function() {
                        t.top_fixed === !0 ? s.addClass(C) : s.removeClass(C), t.mobile_settings.top_fixed && s.addClass(k)
                    },
                    sticky_Header: function() {
                        var i = e(window),
                            a = !0,
                            n = !0;
                        s.find(b).is(":hidden") ? (i.off("scroll"), t.mobile_settings.sticky_header === !0 && t.top_fixed === !1 && i.on("scroll", function() {
                            i.scrollTop() > t.mobile_settings.sticky_header_height ? n === !0 && (s.addClass(k), n = !1) : n === !1 && (s.removeClass(k), n = !0)
                        })) : (i.off("scroll"), t.sticky_header === !0 && "horizontal" === t.menu_position && t.top_fixed === !1 && i.on("scroll", function() {
                            i.scrollTop() > t.sticky_header_height ? a === !0 && (s.fadeOut(200, function() {
                                e(this).addClass(C).fadeIn(200)
                            }), a = !1) : a === !1 && (s.fadeOut(200, function() {
                                e(this).removeClass(C).fadeIn(200)
                            }), a = !0)
                        }))
                    },
                    position: function() {
                        "vertical-left" === t.menu_position ? s.addClass("vertical-left") : s.removeClass("vertical-left"), "vertical-right" === t.menu_position ? s.addClass("vertical-right") : s.removeClass("vertical-right")
                    }
                }, i.logo_Align(), i.links_Align(), i.social_bar_Align(), i.search_bar_Align(), i.collapse_trigger_button(), i.hover_trigger(), e(window).resize(function() {
                    i.outside_close(), i.sticky_Header()
                })
            })
        }
    }(jQuery);
    //, i.mobile_trigger(), i.click_trigger(), i.outside_close(), i.scroll_bar(), i.top_Fixed(), i.sticky_Header(), i.position()