<?php

namespace Controllers;

use Authenticated;
use Fakers\UserFactory;
require_once './Fakers/UserFactory.php';
require_once './Auth/Traits/Authenticated.php';
require_once './Controllers/ApiController.php';

class ResourceController extends ApiController
{
    private array $users = [];
    use Authenticated;

    // Stubbing resources for showing how the API works
    public function __construct()
    {
        parent::__construct();
        $this->requireAuthorization();
        $this->users = UserFactory::fake()->count(10)->make();
    }

    public function list() : void {
        echo json_encode($this->users);
    }

    public function single(string $id): void {
        echo json_encode(
            array_values(array_filter($this->users, fn ($user) => $user->id == $id))[0]
        );
    }
}