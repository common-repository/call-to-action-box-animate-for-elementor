(function($) {
    var WidgetHelloWorldHandler = function($scope, $) {
        var deviceAgent = navigator.userAgent.toLowerCase();
		var detechMobile = deviceAgent.match(/(iphone|ipod|ipad)/);
        var hover = $scope.find('.eb-cta-box');
		if (detechMobile) {
            if ($(hover).hasClass('eb-cta-box-hover')) {
                $(hover).hover(
                    function(e) {
                        $(this).attr('onclick', 'void(0);');
                    },
                    function(e) {
                        $(this).removeAttr('onclick');
                    }
                );

            }
        }
    };

    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/eb-cta-box-animate.default', WidgetHelloWorldHandler);
    });
})(jQuery);