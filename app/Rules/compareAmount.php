<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class compareAmount implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->data['loanAmount_Min'] <= $this->data['loanAmount_Max']){
            $fail(':attribute must be uppercase.');
        }
    }
}
