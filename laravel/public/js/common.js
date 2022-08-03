// import Echo from 'laravel-echo';
 
// window.Pusher = require('pusher-js');
 
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
// import Echo from 'laravel-echo'; 
// Echo = require('laravel-echo');

// window.io = require('socket.io-client');
// window.Echo = new Echo({
//     namespace: 'App.Events',
//     broadcaster: 'socket.io',
//     host: `${window.location.hostname}:3000`
// });
// window._ = require('lodash');

// console.log('a');
// $('#send').on('click', function () {
//     let message = $('#input').val();
//     $('#input').val('');
//     if (message != '') {
//         $.ajax({
//             url: 'test-chat',
//             type: 'POST',
//             dataType: 'json',
//             data: {message: message},
//         });
//     }
// });

// Echo.private('chanel-dev')
//     .listen('ChatEvent', (e) => {
//         console.log(e);
//         $('#content').append(`<div class="well">${e.message}</div>`);
//     });

function addSpinner(ele, position) {
  if (position === undefined) {
    position = 'inner';
  }

  if (position == 'inner') {
    ele.append(' <i class="fa fa-spinner fa-spin"></i>');
  } else if (position == 'after') {
    ele.after('<i class="fa fa-spinner fa-spin"></i>');
  }
}

function removeSpinner(ele, position) {
  if (position === undefined) {
    position = 'inner';
  }

  if (position == 'inner') {
    ele.find('.fa-spin').remove();
  } else if (position == 'after') {
    ele.next().remove();
  }
}
