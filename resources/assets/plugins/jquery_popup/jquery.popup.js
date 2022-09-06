/*
    A simple jQuery modal (http://github.com/kylefox/jquery-modal)
    Version 0.9.2
*/

(function (factory) {
    // Making your jQuery plugin work better with npm tools
    // http://blog.npmjs.org/post/112712169830/making-your-jquery-plugin-work-better-with-npm
    if (typeof module === "object" && typeof module.exports === "object") {
        factory(require("jquery"), window, document);
    }
    else {
        factory(jQuery, window, document);
    }
}(function ($, window, document, undefined) {

    var popups = [],
        getCurrent = function () {
            return popups.length ? popups[popups.length - 1] : null;
        },
        selectCurrent = function () {
            var i,
                selected = false;
            for (i = popups.length - 1; i >= 0; i--) {
                if (popups[i].$blocker) {
                    popups[i].$blocker.toggleClass('current', !selected).toggleClass('behind', selected);
                    selected = true;
                }
            }
        };

    $.popup = function (el, options) {
        var remove, target;
        this.$body = $('body');
        this.options = $.extend({}, $.popup.defaults, options);
        this.options.doFade = !isNaN(parseInt(this.options.fadeDuration, 10));
        this.$blocker = null;
        if (this.options.closeExisting)
            while ($.popup.isActive())
                $.popup.close(); // Close any open popups.
        popups.push(this);
        if (el.is('a')) {
            target = el.attr('href');
            this.anchor = el;
            //Select element by id from href
            if (/^#/.test(target)) {
                this.$elm = $(target);
                if (this.$elm.length !== 1) return null;
                this.$body.append(this.$elm);
                this.open();
                //AJAX
            } else {
                this.$elm = $('<div>');
                this.$body.append(this.$elm);
                remove = function (event, popup) {
                    popup.elm.remove();
                };
                this.showSpinner();
                el.trigger($.popup.AJAX_SEND);
                $.get(target).done(function (html) {
                    if (!$.popup.isActive()) return;
                    el.trigger($.popup.AJAX_SUCCESS);
                    var current = getCurrent();
                    current.$elm.empty().append(html).on($.popup.CLOSE, remove);
                    current.hideSpinner();
                    current.open();
                    el.trigger($.popup.AJAX_COMPLETE);
                }).fail(function () {
                    el.trigger($.popup.AJAX_FAIL);
                    var current = getCurrent();
                    current.hideSpinner();
                    popups.pop(); // remove expected popup from the list
                    el.trigger($.popup.AJAX_COMPLETE);
                });
            }
        } else {
            this.$elm = el;
            this.anchor = el;
            this.$body.append(this.$elm);
            this.open();
        }
    };

    $.popup.prototype = {
        constructor: $.popup,

        open: function () {
            var m = this;
            this.block();
            this.anchor.blur();
            if (this.options.doFade) {
                setTimeout(function () {
                    m.show();
                }, this.options.fadeDuration * this.options.fadeDelay);
            } else {
                this.show();
            }
            $(document).off('keydown.popup').on('keydown.popup', function (event) {
                var current = getCurrent();
                if (event.which === 27 && current.options.escapeClose) current.close();
            });
            if (this.options.clickClose)
                this.$blocker.click(function (e) {
                    if (e.target === this)
                        $.popup.close();
                });
        },

        close: function () {
            popups.pop();
            this.unblock();
            this.hide();
            if (!$.popup.isActive())
                $(document).off('keydown.popup');
        },

        block: function () {
            this.$elm.trigger($.popup.BEFORE_BLOCK, [this._ctx()]);
            this.$body.css('overflow', 'hidden');
            this.$blocker = $('<div class="' + this.options.blockerClass + ' blocker current"></div>').appendTo(this.$body);
            selectCurrent();
            if (this.options.doFade) {
                this.$blocker.css('opacity', 0).animate({opacity: 1}, this.options.fadeDuration);
            }
            this.$elm.trigger($.popup.BLOCK, [this._ctx()]);
        },

        unblock: function (now) {
            if (!now && this.options.doFade)
                this.$blocker.fadeOut(this.options.fadeDuration, this.unblock.bind(this, true));
            else {
                this.$blocker.children().appendTo(this.$body);
                this.$blocker.remove();
                this.$blocker = null;
                selectCurrent();
                if (!$.popup.isActive())
                    this.$body.css('overflow', '');
            }
        },

        show: function () {
            this.$elm.trigger($.popup.BEFORE_OPEN, [this._ctx()]);
            if (this.options.showClose) {
                this.closeButton = $('<a href="#close-popup" rel="popup:close" class="close-popup ' + this.options.closeClass + '">' + this.options.closeText + '</a>');
                this.$elm.append(this.closeButton);
            }
            this.$elm.addClass(this.options.popupClass).appendTo(this.$blocker);
            if (this.options.doFade) {
                this.$elm.css({opacity: 0, display: 'inline-block'}).animate({opacity: 1}, this.options.fadeDuration);
            } else {
                this.$elm.css('display', 'inline-block');
            }
            this.$elm.trigger($.popup.OPEN, [this._ctx()]);
        },

        hide: function () {
            this.$elm.trigger($.popup.BEFORE_CLOSE, [this._ctx()]);
            if (this.closeButton) this.closeButton.remove();
            var _this = this;
            if (this.options.doFade) {
                this.$elm.fadeOut(this.options.fadeDuration, function () {
                    _this.$elm.trigger($.popup.AFTER_CLOSE, [_this._ctx()]);
                });
            } else {
                this.$elm.hide(0, function () {
                    _this.$elm.trigger($.popup.AFTER_CLOSE, [_this._ctx()]);
                });
            }
            this.$elm.trigger($.popup.CLOSE, [this._ctx()]);
        },

        showSpinner: function () {
            if (!this.options.showSpinner) return;
            this.spinner = this.spinner || $('<div class="' + this.options.popupClass + '-spinner"></div>')
                .append(this.options.spinnerHtml);
            this.$body.append(this.spinner);
            this.spinner.show();
        },

        hideSpinner: function () {
            if (this.spinner) this.spinner.remove();
        },

        //Return context for custom events
        _ctx: function () {
            return {
                elm: this.$elm,
                $elm: this.$elm,
                $blocker: this.$blocker,
                options: this.options,
                $anchor: this.anchor
            };
        }
    };

    $.popup.close = function (event) {
        if (!$.popup.isActive()) return;
        if (event) event.preventDefault();
        var current = getCurrent();
        current.close();
        return current.$elm;
    };

    // Returns if there currently is an active popup
    $.popup.isActive = function () {
        return popups.length > 0;
    };

    $.popup.getCurrent = getCurrent;

    $.popup.defaults = {
        closeExisting: true,
        escapeClose: true,
        clickClose: true,
        closeText: '',
        closeClass: '',
        popupClass: "popup",
        blockerClass: "jquery-popup",
        spinnerHtml: '<div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div>',
        showSpinner: true,
        showClose: true,
        fadeDuration: null,   // Number of milliseconds the fade animation takes.
        fadeDelay: 1.0        // Point during the overlay's fade-in that the popup begins to fade in (.5 = 50%, 1.5 = 150%, etc.)
    };

    // Event constants
    $.popup.BEFORE_BLOCK = 'popup:before-block';
    $.popup.BLOCK = 'popup:block';
    $.popup.BEFORE_OPEN = 'popup:before-open';
    $.popup.OPEN = 'popup:open';
    $.popup.BEFORE_CLOSE = 'popup:before-close';
    $.popup.CLOSE = 'popup:close';
    $.popup.AFTER_CLOSE = 'popup:after-close';
    $.popup.AJAX_SEND = 'popup:ajax:send';
    $.popup.AJAX_SUCCESS = 'popup:ajax:success';
    $.popup.AJAX_FAIL = 'popup:ajax:fail';
    $.popup.AJAX_COMPLETE = 'popup:ajax:complete';

    $.fn.popup = function (options) {
        if (this.length === 1) {
            new $.popup(this, options);
        }
        return this;
    };

    // Automatically bind links with rel="popup:close" to, well, close the popup.
    $(document).on('click.popup', 'a[rel~="popup:close"]', $.popup.close);
    $(document).on('click.popup', 'a[rel~="popup:open"]', function (event) {
        event.preventDefault();
        $(this).popup();
    });
}));