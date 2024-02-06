<?php
/*
Plugin Name: My JotForm Plugin
Plugin URI: https://www.yourwebsite.com
Description: This is a custom plugin that uses the Jotform PHP library
Version: 1.0
Author: Your Name
Author URI: https://www.yourwebsite.com
*/

require_once(ABSPATH . 'wp-content/jotform-php/JotForm.php');

function callJotformAPI($formID) {
    $apiKey = 'c4012fa14eeea49906382f39a889d2f2';
    $apiURL = 'https://perkins.jotform.com/API/form/' . $formID . '/source?apikey=' . $apiKey;
    
    $response = file_get_contents($apiURL);
    $data = json_decode($response, true);

    if (isset($data['content'])) {
        return $data['content'];
    } else {
        return "Form source code not found.";
    }
}
function displayJotformForm1() {
    $formID = '240015406525950'; // Form ID for the first form
    $formContent = callJotformAPI($formID);
    return $formContent;
}

function displayJotformForm2() {
    $formID = '233618055784968'; // Form ID for the second form, replace with your new form ID
    $formContent = callJotformAPI($formID);
    return $formContent;
}

function displayJotformForm3() {
    $formID = '240075733152955'; // Form ID for the second form, replace with your new form ID
    $formContent = callJotformAPI($formID);
    return $formContent;
}

add_shortcode('display_jotform_form1', 'displayJotformForm1');
add_shortcode('display_jotform_form2', 'displayJotformForm2');
add_shortcode('display_jotform_form3', 'displayJotformForm3');

function enqueue_my_script() {
    global $post;
    if(is_a($post, 'WP_Post') && (has_shortcode($post->post_content, 'display_jotform_form1') || has_shortcode($post->post_content, 'display_jotform_form2'))) {
        wp_enqueue_script(
            'my-script',
            plugin_dir_url(__FILE__) . 'errormsg.js',
            array('jquery'),
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_my_script');
