<?php

namespace Database\Factories;

use App\Models\PPBEModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PPBEModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = PPBEModel::class;

    public function definition()
    {
        $inspection_code = rand(0,3).rand(0,5);
        $number_list = rand(0,3).rand(0,3).rand(0,3).rand(0,3).rand(0,3);
        $code = $inspection_code.'.'.'24'.'.'.$number_list;
        $status = $this->faker->numberBetween(0,2);
        switch ($status) {
            case 1:
                $status = 'active';
                break;

            case 2:
                $status = 'inactive';
                break;

                default:
                $status = 'pending';
                break;
        }
        return [
            'code' => $code,
            'date' => $this->faker->date,
            'status' => $status,
            'company_name' => $this->faker->words(2,true),
            'office_inspection' =>$this->faker->city,
        ];
    }
}
