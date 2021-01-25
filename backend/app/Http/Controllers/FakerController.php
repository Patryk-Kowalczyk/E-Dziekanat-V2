<?php

declare(strict_types=1);
namespace App\Http\Controllers;


use App\Models\Plan;
use Faker\Factory;
use Illuminate\Support\Carbon;

class FakerController extends Controller
{
    public function __invoke()
    {

//        $faker=Factory::create();
//
//        for ($i = 0; $i < 30; $i++) {
//            $plans=new Plan;
//            $since = $faker->randomElement($array = ['08', '10', '12', '14', '16', '18']) . ':00:00';
//            $to = date('H:i:s', strtotime($since) + 7200);
//            $plans->id = $faker->unique()->numberBetween(10, 40);
//            $plans->since = $since;
//            $plans->to = $to;
//            $plans->room = 'W1'.$faker->numberBetween(0,9);
//            $plans->date = Carbon::today()->addDays(rand(1, 5))->format('Y-m-d');
//            $plans->group_id = $faker->numberBetween(1,2);
//            $plans->educator_id = $faker->numberBetween(1,2);
//            $randomSubject = $faker->randomElement($array = [1, 2, 4, 5, 7, 8, 10, 11]);
//            $plans->subjects()->attach($randomSubject);
//            $plans->save();
//        }

    }
}
