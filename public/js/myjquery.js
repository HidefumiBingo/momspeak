<!-- smooth-scroll -->

        $(function() {
            $('a[href^="#"]').click(function() {
            	var headerHeight = $('header').outerHeight();
                var speed = 400;
                var href = $(this).attr('href');
                var target = $(href == "#" || href === "" ? 'html' : href);
                var position = target.offset().top - headerHeight + 50;
                $('html,body').animate({scrollTop:position},speed,"swing");
                return false;
            });
        });
