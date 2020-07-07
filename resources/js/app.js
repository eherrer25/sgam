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
    authEndpoint : '/sgam/public/broadcasting/auth',
    broadcaster: 'pusher',
    key: '7757e6e9a065c75ddbfc',
    cluster: 'us2',
    encrypted: true
});

var notifications = [];

const NOTIFICATION_TYPES = {
    reminder: 'App\\Notifications\\ReminderTask'
};

$(document).ready(function() {
    if(Laravel.userId) {
        $.get('/sgam/public/admin/notifications', function (data) {
            addNotifications(data, ".noti-list");
            Notification.requestPermission( permission => {
                let notification = new Notification('New post alert!');
            });
        });

        window.Echo.private(`App.User.${Laravel.userId}`)
            .notification((notification) => {
                console.log(notification);
                addNotifications([notification], '.noti-list');
            });
    }
});

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
        to = '/sgam/public/admin/list-nursings'+to;
    } else if(notification.type === NOTIFICATION_TYPES.newPost) {
        const postId = notification.data.post_id;
        to = `posts/${postId}` + to;
    }
    return to;
}

function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.reminder) {
        text += `<strong>Nueva alarma</strong>`;
    } else if(notification.type === NOTIFICATION_TYPES.newPost) {
        const name = notification.data.following_name;
        text += `<strong>${name}</strong> published a post`;
    }
    return text;
}
