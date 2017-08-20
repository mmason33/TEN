<?php
  // API call for the client click event
  header('Content-Type: text/xml');
  $url = 'http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=1';
  $content = file_get_contents($url);
  echo $content;
