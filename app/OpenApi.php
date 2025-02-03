<?php

namespace App;

use OpenApi\Attributes as OA;

// Global API Documentation
#[OA\Info(
    version: "1.0.0",
    title: "Task API",
    description: "Always use the access token generated via api/login. If you don't have an account yet, you can create an account via api/register.",
    contact: new OA\Contact(
        email: "antonio.bolano@web.de",
        name: "API Support"
    )
)]
#[OA\Server(
    url: "http://localhost",
    description: "Local development server."
)]
class OpenApi
{
    // This class is just a placeholder for global OpenAPI attributes
}

