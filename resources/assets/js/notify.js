import swal from 'sweetalert2';
import GrowlNotification from "../plugins/growl-notification/growl-notification.min";

export const notify = (text, type = 'success', title = 'Thông báo') =>
{
    (new GrowlNotification({
        title: title,
        description: text,
        type: type,
        position: 'top-right',
        closeTimeout: 3000
    })).show();
};

export var Storage = {
    getStorage(name) {
        return JSON.parse(localStorage.getItem(name)) || [];
    },
    setStorage(name, data = []) {
        localStorage.setItem(name, JSON.stringify(data));
    },
    delStorage(name) {
        localStorage.removeItem(name);
    }
};

export var convertSize = function (bytes, decimalPoint) {
    if (bytes === 0) return '0 Bytes';
    let k = 1000,
        dm = decimalPoint || 2,
        sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
};

export var loadCss = function (href) {
    var cb = function () {
        var l = document.createElement('link');
        l.rel = "stylesheet";
        l.href = href;
        var h = document.getElementsByTagName('head')[0];
        h.append(l);
    };

    var raf = requestAnimationFrame || mozRequestAnimationFrame || webkitRequestAnimationFrame || msRequestAnimationFrame;
    if (raf) {
        raf(cb);
    } else {
        window.addEventListener('load', cb);
    }
};
