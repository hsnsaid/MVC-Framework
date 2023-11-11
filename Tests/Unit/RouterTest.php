<?php
namespace Tests\Unit;
use App_Core\Route;
use PHPUnit\Framework\TestCase;
use App_Core\Exceptions\RouteNotFoundException;
use PHPUnit\Framework\Attributes\DataProviderExternal;

Class RouterTest extends TestCase{
    private $router;
    protected function setUp() : void{
        parent::setUp();
        $this->route=new Route();
    }
    public function test_there_are_no_route(){
        $route= new Route();
        $this->assertEmpty($route->getroute());
    }
    public function test_if_register_route(){
        $ex=["home"=>["GET"=>["homecontroler","home"]]];
        $this->route->register("home","GET",["homecontroler","home"]);
        $this->assertSame($this->route->getroute(),$ex);
    }
    public function test_if_register_get_route(){
        $route = new Route();
        $ex=["home"=>["GET"=>["homecontroler","home"]]];
        $this->route->get("home",["homecontroler","home"]);
        $this->assertSame($this->route->getroute(),$ex);
    }
    public function test_if_register_post_route(){
        $route = new Route();
        $ex=["home"=>["POST"=>["homecontroler","home"]]];
        $this->route->post("home",["homecontroler","home"]);
        $this->assertSame($this->route->getroute(),$ex);
    }
    #[DataProviderExternal(\Tests\DataProvider\RouterDataProvider::class,'routeDataProvider')]
    public function test_if_route_not_found(string $url,string $methods){
        $this->route->post("/user",[\Controller\UserController::class,"no","Home"]);
        $this->route->get("/user",[\Controller\UserController::class,"file","Home"]);
        $this->route->get("/user/t",[\Controller\no::class,"file","Home"]);
        $this->ExpectException(RouteNotFoundException::class);
        $this->route->resolver($url,$methods);
    }
    public function test_if_resolver_right(){
        $class= new class(){
            public function test(){
                return "it's right";
            }
        };
        $this->route->get("/user",[$class::class,"test"]);
        $this->assertSame("it's right", $this->route->resolver("/user","GET"));
    }
}
?>