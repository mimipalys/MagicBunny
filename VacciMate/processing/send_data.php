<?php
// Create a sample dictionary
$data = array(
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'age' => 30
);

// Convert the dictionary to JSON
$data_json = json_encode($data);

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the JSON response
echo $data_json;
?>
