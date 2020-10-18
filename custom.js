(function ( $ ) {
    'use strict';
    // Click on Download button.
    $("#wpifw_pdf_invoice_download_font").on(
        'click', function (e) {
            e.preventDefault();
            // Get Dropdown value.
            var getFormData = $("#formData").serialize();
            // var selectFont = $("#wpifw-download-pdf-fonts option:selected").val();
            // console.log(font_url);
            $.ajax(
                {
                    url: ajax_plugin_test_object.your_ajax_url,
                    type:'post',
                    dataType: 'json',
                    data:{
                        action: 'plugin_form_submission', selectFont:getFormData,
                        _ajax_nonce: ajax_plugin_test_object.nonce,
                    },
                    success:function (data) {
                        console.log(data.message);

                    },
                    error:function (error) {
                        console.log(error);

                    }
                }
            )
        }
    )
})(jQuery);