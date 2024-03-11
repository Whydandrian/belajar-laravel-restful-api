<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
   protected $table = "contacts";
   protected $keyType = "int";
   protected $primaryKey = "id";
   public $incrementing = true;
   public $timestamps = true;
}
