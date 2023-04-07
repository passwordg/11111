<?php

    // URL of the API endpoint
    $url = "https://api.atm24.pro/currency-exchange-for-legal-entities";

    // Data to send in the request body
    $data = array(
        'transfers' => 'some_value' // Replace 'some_value' with the actual value you want to send
    );

    // Initialize cURL
    $curl = curl_init($url);

    // Set cURL options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL host verification (for testing only)
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL peer verification (for testing only)
    curl_setopt($curl, CURLOPT_POST, true); // Set the request method to POST
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); // Set the request body data

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if(curl_error($curl)) {
        die('Error: ' . curl_error($curl));
    }

    // Close the cURL session
    curl_close($curl);

    // Process the API response
    if($response) {
        // Decode the JSON response into an array
        $responseArray = json_decode($response, true);

        // Check if the response is valid JSON
        if($responseArray) {
            // Extract the "pair" and "rate" from the response
            $pair = $responseArray['pair'];
            $rate = $responseArray['rate'];

            // Display the "pair" and "rate" in an HTML table
            echo "<table>";
            echo "<tr><th>Pair</th><th>Rate</th></tr>";
            echo "<tr><td>$pair</td><td>$rate</td></tr>";
            echo "</table>";

            // Display the "pair" and "rate" as text
            echo "<p>Pair: $pair</p>";
            echo "<p>Rate: $rate</p>";
        } else {
            echo "Error: Invalid API response";
        }
    } else {
        echo "Error: Failed to fetch data from API";
    }

    ?>