"use strict";

var KTSessionTimeoutDemo = function () {
    var initDemo = function () {

        var warnAfter = 20000; //warn after 5000 seconds - 83 mins
        var redirAfter = 600000; //redirect after 5050 seconds - 84.16 mins.
        var redirect;
        
        var sessionTimeout = function () {
            var lastActivity = new Date().getTime();
            var timeout;

            var resetTimeout = function () {
                clearTimeout(timeout);
                clearTimeout(redirect);
                startTimeout();
            };

            var startTimeout = function () {
                timeout = setTimeout(function () {
                    showWarning();
                    redirect = setTimeout(()=> {
                        window.location.href = base_url + '/session-time-out';
                    }, warnAfter);
                }, redirAfter - warnAfter);
            };

            var showWarning = function () {
                var $timeoutNotification = $('<div>', {
                    class: 'session-timeout-notification',
                    text: 'Your session is about to expire. Do you want to stay logged in?',
                    css: {
                        position: 'fixed',
                        top: '20px',
                        left: '34%',
                        padding: '10px',
                        background: '#fff',
                        border: '1px solid #ccc',
                        borderRadius: '4px',
                        boxShadow: '0 2px 4px rgba(0, 0, 0, 0.1)',
                        zIndex: 9999
                    }
                });

                var $cancelButton = $('<button>', {
                    text: 'Stay Logged In',
                    class: 'btn btn-sm btn-success me-3 ms-12',
                    click: function () {
                        resetTimeout();
                        $timeoutNotification.remove();
                    }
                });

                var $closeButton = $('<button>', {
                    text: 'Log Out',
                    class: 'btn btn-sm btn-danger',
                    click: function () {
                        window.location.href = base_url + '/session-time-out';
                    }
                });

                $timeoutNotification.append($cancelButton, $closeButton);
                $('body').append($timeoutNotification);
            };

            $(document).on('mousemove keydown', function () {
                lastActivity = new Date().getTime();
                resetTimeout();
            });

            startTimeout();
        };

        sessionTimeout();
    };

    return {
        init: function () {
            initDemo();
        }
    };
}();

$(document).ready(function() {
    KTSessionTimeoutDemo.init();
});
