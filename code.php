<?php
/**
 * Plugin Name: Ajax Form Submission
 */

class Plugin_name
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'sub_menu_callback']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts_callback']);
        add_action('wp_ajax_plugin_form_submission', array($this, 'plugin_form_submission_callback'));
    }

    /**
     * Callback for download custom fonts.
     *
     * @return void
     */
    public function plugin_form_submission_callback()
    {

        parse_str($_POST['form_data'], $searcharray);

        $data['name'] = $searcharray['name'];
        $data['email'] = $searcharray['email'];
        $data['phone'] = $searcharray['phone'];
        update_option('testgd', $data);
        $response['message'] = 'data send successfully';
        $response['request_url'] = admin_url() . 'admin.php?page=wp_aax_testing';
        echo json_encode($response);
        wp_die();

    }


    public function sub_menu_callback()
    {
        add_menu_page('My Custom Page', 'Ajax Form', 'manage_options', 'wp_aax_testing', [$this, 'wp_aax_testing_callback']);
    }


    public function wp_aax_testing_callback()
    {

        ?>

        <div class="wrap">

            <form action="" name="form-data" id="formData" method="post">
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>

                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="form-control">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" id="phone">
                </div>

                <div class="form-control">
                    <input type="submit" value="submit" id="submitButton">
                </div>

            </form>

            <br>
            <br>


            <?php
            $dataData = get_option('testgd');
            ?>
            <table border="1" cellpadding="20">
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
                <?php foreach ($dataData as $key => $value) { ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                        <td><?php echo $value; ?></td>
                    </tr>

                <?php } ?>

            </table>


        </div>

        <style>
            .wrap {
                padding: 20px;
                border: 1px solid #ccc;
                text-align: left;
                background: #eee;
                max-width: 600px;
                margin: 75px auto;
            }

            .wrap
        </style>


        <?php

    }


    public function admin_enqueue_scripts_callback()
    {
        // Download Custom Fonts Js.
        wp_enqueue_script('ajax-plugin-test-script', plugin_dir_url(__FILE__) . 'custom.js', array('jquery'), '324234', true);
        $ajax_nonce = wp_create_nonce('nonce_name');
        wp_localize_script(
            'ajax-plugin-test-script',
            'ajax_plugin_test_object',
            array(
                'your_ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => $ajax_nonce,
            )
        );

    }


}


new Plugin_name();


?>