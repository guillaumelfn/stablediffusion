# stablediffusion
Stable Diffusion dreams API in PHP

index.html -> jquery front-end where you enter your prompt, which calls index.php and display the picture in out/ directory (must be writeable)

index.php -> instanciate StablityApi.php (contains API key)

StabilityApi.php -> From the python example of Stability to PHP (It's a simple CURL really)

YOU MUST CREATE A ./out directory, OR change StabilityApi to save the picture elsewhere.

works pretty well. 26.06.2023


enjoy ! 


