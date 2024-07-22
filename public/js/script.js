    $(document).ready(function() {
      $('.gallery img').click(function() {
        var imageUrl = $(this).attr('src');

        var modalHtml = '<div class="modal">' +
                        '<span class="close">&times;</span>' +
                        '<img class="modal-content" src="' + imageUrl + '">' +
                        '<div class="navigation">' +
                        '<button class="prev">&#8249;</button>' +
                        '<button class="next">&#8250;</button>' +
                        '</div>' +
                        '</div>';

        $('body').append(modalHtml);

        $('.close').click(function() {
          $('.modal').remove();
        });

        $('.modal').click(function() {
          var currentImage = $('.modal-content').attr('src');
          var nextImage = $('.gallery img[src="' + currentImage + '"]').next().attr('src');
          var prevImage = $('.gallery img[src="' + currentImage + '"]').prev().attr('src');

          if (nextImage) {
            $('.modal-content').attr('src', nextImage);
          } else {
            var firstImage = $('.gallery img:first-child').attr('src');
            $('.modal-content').attr('src', firstImage);
          }
        });

        $('.prev').click(function(e) {
          e.stopPropagation();
          var currentImage = $('.modal-content').attr('src');
          var prevImage = $('.gallery img[src="' + currentImage + '"]').prev().attr('src');

          if (prevImage) {
            $('.modal-content').attr('src', prevImage);
          } else {
            var lastImage = $('.gallery img:last-child').attr('src');
            $('.modal-content').attr('src', lastImage);
          }
        });

        $('.next').click(function(e) {
          e.stopPropagation();
          var currentImage = $('.modal-content').attr('src');
          var nextImage = $('.gallery img[src="' + currentImage + '"]').next().attr('src');

          if (nextImage) {
            $('.modal-content').attr('src', nextImage);
          } else {
            var firstImage = $('.gallery img:first-child').attr('src');
            $('.modal-content').attr('src', firstImage);
          }
        });
      });
    });



