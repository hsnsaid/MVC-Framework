<?php 
namespace Tests\DataProvider ;
final class RouterDataProvider{
    public static function routeDataProvider(): array{
        return [
            ["/use","GET"],
            ["/user","PUT"],
            ["/user/t","GET"],
            ["/user","POST"],
        ];
    }
}
?>