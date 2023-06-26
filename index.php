<?php

// call class

require_once("StabilityApi.php");

// configuration - add your API Key

$api_host = 'https://api.stability.ai';
$api_key = "sk-XXXXXX";

// Get the prompt from front-end

$prompt = $_GET['prompt'];

$api = new StabilityApi("stable-diffusion-v1-5", $api_host, $api_key);
$api->generateImage($prompt);

?>
