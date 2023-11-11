<?php 
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use App_Core\Validator;

class ValidatorTest extends TestCase {
    private Validator $validator;
    public function setUp(): void {
        parent::setUp();
        $this->validator = new Validator();
    }
    #[DataProviderExternal(\Tests\DataProvider\ValidatorDataProvider::class,'passwordDataProvider')]
    public function test_it__validat_password(string $password,bool $result){
        $isValid=$this->validator->validatePassword($password);
        $this->assertSame($result,$isValid);
    }
    #[DataProviderExternal(\Tests\DataProvider\ValidatorDataProvider::class,'emailDataProvider')]
   public function test_it_validat_email(string $email,bool $result){
    $isValid=$this->validator->validateEmail($email);
    $this->assertSame($result,$isValid);
   }
}
?>