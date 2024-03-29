# About
This project is written on clean PHP 8.0 without using any framework or library

I`ve tried to copy the concept of Laravel framework. So, basically, I wrote routing system (with parameterized routes) and user custom controllers

Code example of routing system:
```php
$router = new Router();
$router->get('/example', [ExampleController::class, 'index']);
$router->get('/home', [ExampleController::class, 'home']);
$router->get('/users', [ResourceController::class, 'list']);
$router->get('/users/{id}', [ResourceController::class, 'single']);
$router->get('/users/{name}/{surname}', [ResourceController::class, 'test']);

$executor = new RouterExecutor($router);
$executor->execute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
```

Sample code of contoller:
```php
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
        $user = array_filter($this->users, fn ($user) => $user->id == $id);
        $user = reset($user);
        if (empty($user)) {
            echo new NotFoundResponse();
            exit;
        }

        echo json_encode(
            $user
        );
    }
    public function test(string $name, string $surname) {
        echo json_encode(['name' => $name, 'surname' => $surname]);
    }
}
```

**Note: If you want to make your contoller or action authorized, simply use trait Authenticated and use it`s method $this->requireAuthorization();**

# Running RESTful service
All you have to do is just to type this command:
```
  php -S localhost:8000
```
Done! The application is working now!

To access the resource try stub auth model:
Login: admin
Password: 123123

# Swagger API documentation
<img src="https://i.imgur.com/id4BSZi.png" />
<img src="https://i.imgur.com/68bLEi5.png" />
<img src="https://i.imgur.com/hvDfdUm.png" />
