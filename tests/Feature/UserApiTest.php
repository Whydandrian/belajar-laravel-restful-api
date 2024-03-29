<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
   /**
    * A basic feature test example.
    */
   public function testRegisterSuccess()
   {
      $this->post('/api/users', [
         'username' => 'wahyudi',
         'password' => 'rahasia',
         'name' => 'wahyu',
      ])->assertStatus(201)
         ->assertJson([
            "data" => [
               'username' => 'wahyudi',
               'name' => 'wahyu',
            ]
         ]);
   }
   public function testRegisterFailed()
   {
      $this->post('/api/users', [
         'username' => '',
         'password' => '',
         'name' => '',
      ])->assertStatus(400)
         ->assertJson([
            "errors" => [
               'username' => [
                  "The username field is required."
               ],
               'password' => [
                  "The password field is required."
               ],
               'name' => [
                  "The name field is required."
               ],

            ]
         ]);
   }
   public function testRegisterUsernameAlreadyExist()
   {
      $this->testRegisterSuccess();

      $this->post('/api/users', [
         'username' => 'wahyudi',
         'password' => 'rahasia',
         'name' => 'wahyu',
      ])->assertStatus(400)
         ->assertJson([
            "errors" => [
               'username' => [
                  'username already registered'
               ],
            ]
         ]);
   }

   public function testLoginSuccess()
   {
      $this->seed(UserSeeder::class);
      $this->post('/api/users/login', [
         'username' => 'test',
         'password' => 'test',
      ])->assertStatus(200)->assertJson([
         'data' => [
            'username' => 'test',
            'name' => 'test',
         ]
      ]);

      $user = User::where('username', 'test')->first();

      self::assertNotNull($user->token);
   }
   public function testLoginFailedUsernameNotFound()
   {
      $this->post('/api/users/login', [
         'username' => 'test',
         'password' => 'test',
      ])->assertStatus(401)->assertJson([
         'errors' => [
            'message' => [
               'username or password wrong'
            ],

         ]
      ]);
   }

   public function testLoginPasswordWrong()
   {
      $this->seed(UserSeeder::class);
      $this->post('/api/users/login', [
         'username' => 'test',
         'password' => 'salah',
      ])->assertStatus(401)->assertJson([
         'errors' => [
            'message' => [
               'username or password wrong'
            ],

         ]
      ]);
   }

   public function testSuccess()
   {
      $this->seed(UserSeeder::class);

      $this->get('/api/users/current', [
         'Authorization' => 'test'
      ])->assertStatus(200)->assertJson([
         'data' => [
            'username' => 'test',
            'name' => 'test',
         ],
      ]);
   }
   public function testGetUnauthorized()
   {
      $this->seed(UserSeeder::class);

      $this->get('/api/users/current')->assertStatus(401)->assertJson([
         'errors' => [
            'message' => [
               'unauthorized'
            ],
         ]
      ]);
   }
   public function testGetInvalidToken()
   {
      $this->seed(UserSeeder::class);

      $this->get('/api/users/current', [
         'Authorization' => 'salah'
      ])->assertStatus(401)->assertJson([
         'errors' => [
            'message' => [
               'unauthorized'
            ],
         ]
      ]);
   }
}
