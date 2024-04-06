<?php

class RequestHandler {
    public function handleRequest($request) {
        // Assuming $request is an associative array representing the HTTP request
        
        // Extract necessary information from the request
        $method = $request['method']; // HTTP method (GET, POST, etc.)
        $url = $request['url']; // Requested URL
        $params = $request['params']; // Request parameters
        
        // Process the request based on the method and URL
        switch ($method) {
            case 'GET':
                $response = $this->handleGetRequest($url, $params);
                break;
            case 'POST':
                $response = $this->handlePostRequest($url, $params);
                break;
            // Handle other HTTP methods as needed
            default:
                $response = $this->handleUnsupportedMethod();
        }
        
        // Return the response
        return $response;
    }
    
    private function handleGetRequest($url, $params) {
        // Process GET request here
        // Example: return data based on URL and parameters
        return "GET request handled for URL: $url with parameters: " . json_encode($params);
    }
    
    private function handlePostRequest($url, $params) {
        // Process POST request here
        // Example: save data based on URL and parameters
        return "POST request handled for URL: $url with parameters: " . json_encode($params);
    }
    
    private function handleUnsupportedMethod() {
        // Handle unsupported HTTP methods
        return "Unsupported HTTP method";
    }
}

// Example usage
$request = [
    'method' => 'GET',
    'url' => '/example',
    'params' => ['param1' => 'value1', 'param2' => 'value2']
];

$handler = new RequestHandler();
$response = $handler->handleRequest($request);
echo $response;
