(function () {
    var $dfd = $.Deferred();
    var LoginGoogle = {
        authGoogle: '',
        data: '',
        isApiLoaded: false,
        settings: {},
        init: function (options) {
            this.ggAsyncInit(options);
            this.setOption(options);
        },
        ggAsyncInit: function (options) {
            let _this = this;
            _this.loadScript(document, 'script', 'google-login', options.jsSrc, () => {
                window.gapi.load('auth2', () => {
                    if (!window.gapi.auth2.getAuthInstance()) {
                        gapi.load('auth2', function () {
                            _this.authGoogle = gapi.auth2.init({
                                client_id: _this.settings.appID,
                                cookiepolicy: 'single_host_origin',
                                scope: 'profile'
                            });
                            _this.isApiLoaded = true;
                            let element = document.getElementById($(_this.settings.element).attr('id'));
                            _this.attachSigninGoogle(element);
                        });
                    }
                    if (_this.isApiLoaded) {
                        _this.initAppGoogle();
                    }
                })
            })
        },
        setOption(options) {
            this.settings = options;
        },
        loadScript(d, s, id, jsSrc, cb) {
            const element = d.getElementsByTagName(s)[0];
            const fjs = element;
            let js = element;
            js = d.createElement(s);
            js.id = id;
            js.src = jsSrc;
            if (fjs && fjs.parentNode) {
                fjs.parentNode.insertBefore(js, fjs)
            } else {
                d.head.appendChild(js)
            }
            js.onload = cb
        },
        initAppGoogle() {
            let _this = this;
            gapi.load('auth2', function () {
                _this.authGoogle = gapi.auth2.init({
                    client_id: _this.settings.appID,
                    cookiepolicy: 'single_host_origin',
                    scope: 'profile'
                });
                element = document.getElementById($(_this.settings.element).attr('id'));
                _this.attachSigninGoogle(element);
            });
        },
		attachSigninGoogle(element) {
            this.authGoogle.attachClickHandler(element, {}, function (googleUser) {
                if (googleUser) {
                    let profile = googleUser.getBasicProfile();
                    let data_user = {
                        name: profile.getName(),
                        id: profile.getId(),
                        avatar: profile.getImageUrl(),
                        password: profile.getEmail(),
                        email: profile.getEmail()
                    };
                    $dfd.resolve({
                        data: data_user,
                        code: 200
                    });
                }
            }, function (error) {
                $dfd.reject(error);
            });
        }
    };

    $.fn.login_google = function (options) {
        let defaults = {
            appID: '',
            jsSrc: 'https://apis.google.com/js/api.js',
            element: this
        };

        let settings = $.extend({}, defaults, options);

        this.each(function (i, element) {
            LoginGoogle.init(settings);
        });

        return $dfd;
    };
}(jQuery));