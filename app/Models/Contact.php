<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
   protected $table = "contacts";
   protected $keyType = "int";
   protected $primaryKey = "id";
   public $incrementing = true;
   public $timestamps = true;

   public function users(): BelongsTo
   {
      return $this->belongsTo(Contact::class, "user_id", "id");
   }
}
