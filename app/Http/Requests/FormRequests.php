<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Package\Attribute\UseValidate;
use ReflectionClass;

class FormRequests extends FormRequest
{


    private array $rule;
    private bool $auth = false;

    public function __construct()
    {
        parent::__construct();
        $reflection = new ReflectionClass($this);
        dd($reflection->getAttributes(UseValidate::class));
        // foreach ($reflection->getAttributes() as $attribute) {
        //     if ($attribute instanceof UseValidate) {
        //         dd($attribute->rules);
        //     }
        // }
    }
    /**
     * rules
     */
    public function setRules(array $rules)
    {
        $this->rule = $rules;
    }

    /**
     * auth
     */
    public function setAuth(bool $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->auth;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return  $this->rule;
    }
}
