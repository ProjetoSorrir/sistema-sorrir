<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class BigNumbersService
{
    public function __construct()
    {
    }

    public function getRandomNumbers(int $total_tickets, array $taken_tickets, int $num_tickets_needed)
    {
        $client = new Client();
        $url = 'https://rifando-big-numbers-app-3wogi.ondigitalocean.app/calculate_numbers';

        try {
            $response = $client->request('POST', $url, [
                'json' => [
                    'total_tickets' => $total_tickets,
                    'taken_tickets' => $taken_tickets,
                    'num_tickets_needed' => $num_tickets_needed,
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle client errors (4xx responses) more specifically
            throw new Exception("Client error: Invalid request parameters");
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            // Handle server errors (5xx responses)
            throw new Exception("Server error: Problems at the server");
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Handle other types of Guzzle exceptions
            throw new Exception("Networking error or unknown error occurred");
        }
    }

    /**
     * Generates a specified number of random numbers within a given range,
     * ensuring that these numbers are not already reserved.
     *
     * @param int $totalNumbers Total numbers in the range (1 to totalNumbers)
     * @param array $reservedNumbers Array of numbers that cannot be selected
     * @param int $requestNumberQuantity The number of random numbers to generate
     * @return array An array containing the generated random numbers
     */
    public function getRandomNumbersPHP($totalNumbers, $reservedNumbers, $requestNumberQuantity)
    {
        $availableNumbers = array_diff(range(1, $totalNumbers), $reservedNumbers);
        if (count($availableNumbers) < $requestNumberQuantity) {
            // throw new Exception("Not enough available numbers to fulfill the request.");
        }
        $randomKeys = array_rand($availableNumbers, $requestNumberQuantity);
        // Ensure randomKeys is always an array
        $randomKeys = (array) $randomKeys;
        // Array_flip requires the values to be the keys for array_intersect_key to work correctly
        $selectedNumbers = array_intersect_key($availableNumbers, array_flip($randomKeys));
        // Array_intersect_key will preserve keys, so use array_values to reset them
        return array_values($selectedNumbers);
    }
}