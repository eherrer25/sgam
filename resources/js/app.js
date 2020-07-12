/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');

window._ = require('lodash');
require('bootstrap-sass');
window.Pusher = require('pusher-js');
import Echo from "laravel-echo";

window.Echo = new Echo({
    authEndpoint : '/broadcasting/auth',
    broadcaster: 'pusher',
    key: '0cd4f5e442d158983448',
    cluster: 'us2',
    forceTLS: true,
    encrypted: true,
});

var notifications = [];

const NOTIFICATION_TYPES = {
    reminder: 'App\\Notifications\\ReminderTask',
    alarm: 'App\\Notifications\\AlarmNotification',
};
if(Laravel.userId) {
    $.get('/admin/notifications', function (data) {
        addNotifications(data, ".noti-list");

        if(data.length > 0){
            Notification.requestPermission( permission => {
                if(data.type === NOTIFICATION_TYPES.reminder) {
                    let notification = new Notification('Nuevo cuidado!');
                } else if(data.type === NOTIFICATION_TYPES.alarm) {
                    let notification = new Notification('Nueva alarma!');
                }
            });
        }
    });

    window.Echo.private(`App.User.${Laravel.userId}`).notification((notification) => {
        addNotifications([notification], '.noti-list');
        Notification.requestPermission( permission => {
            if(notification.type === NOTIFICATION_TYPES.reminder) {
                let notification = new Notification('Nuevo cuidado!');
            } else if(notification.type === NOTIFICATION_TYPES.alarm) {
                let notification = new Notification('Nueva alarma!');
            }

        });
    });
}
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target).html(htmlElements.join(''));
        $('.badge-counter').text(notifications.length);
    } else {
        $(target).html('<span class="p-2">Sin notificaciones</span>');
        $('.badge-counter').text(notifications.length);
    }
}

function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);

    return '<a class="dropdown-item d-flex align-items-center" href="' + to + '">'+
        '<div class="mr-3"><div class="icon-circle bg-primary"><i class="fas fa-clipboard-list text-white"></i></div></div>'+
        '<div><span class="font-weight-bold">' + notificationText + '</span></div></a>';
}

function routeNotification(notification) {
    var to = `?read=${notification.id}`;
    if(notification.type === NOTIFICATION_TYPES.reminder) {
        to = '/admin/list-nursings'+to;
    } else if(notification.type === NOTIFICATION_TYPES.alarm) {
        to = '/admin/list-alarms'+to;
    }
    return to;
}

function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.reminder) {
        text += `<strong>Nuevo cuidado</strong>`;
    } else if(notification.type === NOTIFICATION_TYPES.alarm) {
        text += `<strong>Nueva alarma</strong>`;
    }
    return text;
}
