<?php

namespace App\Services;

use GuzzleHttp\Client;

class ContentfulService
{
    protected $client;
    protected $spaceId;
    protected $accessToken;
    protected $environment;
        
    public function __construct()
    {
        $this->client = new Client();
        $this->spaceId = config('app.mySpace');
        $this->accessToken = config('app.myAccessToken');
        $this->environment = config('app.myEnvironment');
    }

    public function fetchEntries($contentType)
    {
        $url = "https://cdn.contentful.com/spaces/{$this->spaceId}/environments/{$this->environment}/entries?access_token={$this->accessToken}";

        $response = $this->client->request('GET',  $url, [
            'query' => [
                'access_token' => $this->accessToken,
                'content_type' => $contentType
            ]
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }
}

?>