<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequesttradeinsRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'email',
                    'mark' => 'required',
                    'model' => 'required',
                    'year' => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'gearbox' => 'required',
                    'trade_in_mark' => 'required',
                    'trade_in_model' => 'required',
                    'trade_in_year' => 'required|numeric',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'email',
                    'mark' => 'required',
                    'model' => 'required',
                    'year' => 'required|numeric',
                    'mileage' => 'required|numeric',
                    'gearbox' => 'required',
                    'trade_in_mark' => 'required',
                    'trade_in_model' => 'required',
                    'trade_in_year' => 'required|numeric',
                ];
            }
            default:
                break;
        }
        return [
            //
        ];
    }
}
