$(document).ready(() => {
  // console.log(window.location.hostname)
  var socket = io(window.location.hostname + ':3000', { 
    secure: true, 
    reconnect: true, 
    rejectUnauthorized : false,
    // transports: ['websocket', 'polling'],
  });

  socket.on('blog_database_channel-dev',function(data){
    console.log(data)
  })

  socket.on('blog_database_channel-support',function(data){
      console.log(data)
  })

  // socket.on('chat:message', function(data) {
  //   console.log(data)
  // })

  // socket.on('blog_database_channel-dev:message',function(data){
  //   console.log(data)
  // })

  // $(document).on('click', '.btn-test', function () {
  //   console.log('hi')
  //   socket.emit("channel_dev", "world");
  //   socket.emit("channel_chem_gio", "world2");
  //   socket.emit("message", "world");
  //   socket.emit("message", "world2");
  // });
  
  // $(document).on('click', '.btn-edit-post', function(){
  //   var $thisButton = $(this);
  //   var url = $thisButton.data('url');
  //
  //   addSpinner($thisButton);
  //   $.ajax({
  //     type: 'GET',
  //     url: url,
  //
  //     success: function (data) {
  //       removeSpinner($thisButton);
  //
  //       if (data.success) {
  //         console.log(data.html)
  //         console.log('---')
  //         console.log(data.success)
  //         // $('.email-contact-' + id).html(email);
  //         $('#admin-model .modal-content').html(data.html);
  //         $('#admin-model').modal('show');
  //       } else {
  //         alert(data.message)
  //       }
  //     },
  //     error: function (data) {
  //       removeSpinner($thisButton);
  //     },
  //     ajaxError: function (data) {
  //       removeSpinner($thisButton);
  //     }
  //   });
  // });

  $(document).on('click', '.btn-delete-post', function(event){
    var $thisButton = $(this);
    var url = $thisButton.data('url');

    var result = confirm('Are you sure you want to delete this record?');

    if (!result) {
      event.preventDefault();
      return false;
    }

    addSpinner($thisButton);
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'DELETE',
      url: url,

      success: function (data) {
        location.reload();
        removeSpinner($thisButton);
      },
      error: function (data) {
        removeSpinner($thisButton);
      },
      ajaxError: function (data) {
        removeSpinner($thisButton);
      }
    });
  });

  $(document).on('click', '.btn-view-post', function(){
    var $thisButton = $(this);
    var url = $thisButton.data('url');
    addSpinner($thisButton);
    $.ajax({
      type: 'GET',
      url: url,

      success: function (data) {
        removeSpinner($thisButton);

        if (data.success) {
          console.log(data.html)
          $('#admin-model .modal-content').html(data.html);
          $('#admin-model').modal('show');
        } else {
          alert(data.message)
        }
      },
      error: function (data) {
        removeSpinner($thisButton);
      },
      ajaxError: function (data) {
        removeSpinner($thisButton);
      }
    });
  });
})
