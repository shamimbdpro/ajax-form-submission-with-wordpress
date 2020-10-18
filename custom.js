(function ( $ ) {
    'use strict';
    // Click on Download button.
    $("#submitButton").on(
        'click', function (e) {
            e.preventDefault();
            // Get Dropdown value.
            var getFormData = $("#formData").serialize();
            var url = ajax_plugin_test_object.your_ajax_url;
            $.ajax(
                {
                    url: url,
                    type:'post',
                    dataType: 'json',
                    data:{
                        action: 'plugin_form_submission', form_data:getFormData,
                        _ajax_nonce: ajax_plugin_test_object.nonce,
                    },
                    success:function (data) {
                        console.log(data.message);
                        $('body').load(data.request_url);
                    },
                    error:function (error) {
                        console.log(error);

                    }
                }
            )
        }
    )
})(jQuery);