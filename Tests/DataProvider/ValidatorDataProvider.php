<?php 
namespace Tests\DataProvider ;
final class ValidatorDataProvider{
    public static function passwordDataProvider(): array{
        return [
            'valid password'=> ["7H080255s",TRUE],
            'no small letters'=> ["7H080255",FALSE],
            'no capital letters'=> ["7h080255s",FALSE],
            'no numbers'=> ["said",FALSE],
        ];
    }
    public static function emailDataProvider(): array{
        return [
            'not properly formatted'=> ["said",FALSE],
            'valid email'=> ["said@gmail.com",TRUE],
            'not properly formatted'=> ["said@gmail",FALSE],
            'too short'=> ["a@gmail.dz",FALSE],
            'too long'=> ["jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj@gmail.dz",FALSE],
        ];
       }    
}
?>