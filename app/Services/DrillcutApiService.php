<?php

namespace App\Services;

class DrillcutApiService {

    protected $apiUrl;

    public function __construct() 
    {
        $this->apiUrl = config('app.api_url');
    }

}

?>