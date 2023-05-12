<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email',
		];

		if ($this->has('phone') && $this->phone != '') {
			$rules['phone'] = 'integer';
		}

		if ($this->has('new_password') && $this->new_password != '') {
			$rules['new_password'] = 'min:8';
			$rules['current_password'] = 'required';
		}

		if ($this->has('current_password') && $this->current_password != '') {		
			$rules['new_password'] = 'required|min:8';
			$rules['current_password'] = [
				'min:8',
				function ($attribute, $value, $fail) {
					if (!Hash::check($value, auth('api')->user()->password)) {
						$fail("Incorrect current password.");
					}
				}
			];
		}

		return $rules;
	}
}