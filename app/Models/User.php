<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements Authenticatable
{
   protected $table = 'users';
   protected $primaryKey = 'id';
   protected $keyType = 'int';
   public $incrementing = true;
   public $timestamps = true;

   protected $fillable = [
      "username", "password", "name"
   ];

   public function contacts(): HasMany
   {
      return $this->hasMany(Contact::class, "user_id", "id");
   }

   public function getAuthIdentifierName()
   {
   }


   public function getAuthIdentifier()
   {
   }

   public function getAuthPassword()
   {
   }

   public function getRememberToken()
   {
   }

   public function setRememberToken($value)
   {
   }
   public function getRememberTokenName()
   {
   }
}
