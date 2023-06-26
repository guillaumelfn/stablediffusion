<?php

class StabilityApi
{
    private $engine_id;
    private $api_host;
    private $api_key;

    public function __construct($engine_id, $api_host, $api_key)
    {
        $this->engine_id = $engine_id;
        $this->api_host = $api_host;
        $this->api_key = $api_key;

        if ($this->api_key == null) {
            throw new Exception("Missing Stability API key.");
        }
    }

    public function generateImage($prompt)
    {
        $url = "$this->api_host/v1/generation/$this->engine_id/text-to-image";
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer $this->api_key"
        ];
        $postdata = [
            "text_prompts" => [
                [
                    "text" => $prompt
                ]
            ],
            "cfg_scale" => 7,
            "clip_guidance_preset" => "FAST_BLUE",
            "height" => 512,
            "width" => 512,
            "samples" => 1,
            "steps" => 30,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
            throw new Exception("Non-200 response: " . $response);
        }

        $data = json_decode($response, true);

        foreach ($data["artifacts"] as $i => $image) {
            file_put_contents("./out/v1_txt2img_$i.png", base64_decode($image["base64"]));
        }

        curl_close($ch);
    }
}
