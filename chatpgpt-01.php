<?php
//https://www.youtube.com/watch?v=Hdi_NitQNrU
$chatgpt_key = '';
$search_string = "Write a tagline for an ice cream shop.";
get_chatgpi_service($search_string, $chatgpt_key);
function get_chatgpi_service($search_string = '', $chatgpt_key = '') {
    /*2023-06-02*/
    $max_tokens = 64;
    $model = "text-davinci-001";
    $post_data = array(
		"model" => $model, 
		"prompt" => $search_string, 
		"temperature" => 0.4, 
		"max_tokens" => $max_tokens, 
		"top_p" => 1, 
		"frequency_penalty" => 0, 
		"presence_penalty" => 0
	);
    $postdata = json_encode($post_data);
    $result = array();
    try {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer ' . $chatgpt_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error 1: ' . curl_error($ch);
        }
        print_array($ch);
        curl_close($ch);
    }
    catch(Exception $e) {
        echo 'Error 2: ' . $e->getMessage();
    }
    print_array($result);
}
function print_array($arr) {
    print ("<pre>");
    print_r($arr);
    print ("</pre>");
}
