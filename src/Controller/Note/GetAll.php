<?php

declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(
        Request $request,
        Response $response
    ): Response {      
        
        $description = $request->getQueryParam('description', null);
        
        $privatKey = "a4825234f4bae72a0be04eafe9e8e2bada209255";
        $jsonString = $description;
        
        $data = base64_encode($jsonString);
        $signature = base64_encode(sha1($privatKey . $data . $privatKey, true));
        $notes = $data . ' ' . $signature;
        return $this->jsonResponse($response, 'success', $notes, 200);
    }
}
