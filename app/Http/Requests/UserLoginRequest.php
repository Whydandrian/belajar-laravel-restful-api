<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

   public function authorize(): bool
   {
      return false;
   }

   public function rules(): array
   {
      return [
         //
      ];
   }
}
