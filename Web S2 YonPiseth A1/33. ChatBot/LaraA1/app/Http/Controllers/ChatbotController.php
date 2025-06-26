<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'Gemini API key not configured.'], 500);
        }

        $client = new Client([
            'verify' => false, // Disable SSL verification for development
        ]);
        $model = 'gemini-1.5-flash'; // The specific Gemini model (updated based on user feedback)
        // The Project ID is not needed for direct API key access to Generative Language API
        // $projectId = env('GOOGLE_CLOUD_PROJECT_ID');

        $url = "https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}";

        try {
            $response = $client->post($url, [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $userMessage]
                            ]
                        ]
                    ]
                ]
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            $botReply = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from Gemini.';

            return response()->json(['reply' => $botReply]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error communicating with Gemini API: ' . $e->getMessage()], 500);
        }
    }
}
