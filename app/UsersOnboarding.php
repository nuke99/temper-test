<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class UsersOnboarding extends Model
{

    protected $table = 'users_onboarding';


    public function scopeStepOfRegistrationStoppedAt($query, $step)
    {
        return $query->where('onboarding_percentage', '>=', $step);
    }


    public function scopeGroupByWeek($query)
    {
        return $query->groupBy('week_of_year');
    }

    public function scopeInTheWeekOfYear($query, $week)
    {
        return $query->where(DB::raw('WEEK(created_at)'), '=', $week);
    }


    public function getWeekGroups()
    {
        return $this->select(
            DB::raw("WEEK(created_at) as week_of_year"),
            DB::raw("count(user_id) as user_count")
        )->groupByWeek()->get();
    }

    public function getWeeklyStepProcessCount($week, $step)
    {
        return $this->stepOfRegistrationStoppedAt($step)
            ->inTheWeekOfYear($week)
            ->count();
    }

    /**
     * Get Weekly Cohorts
     *
     * @return array
     */
    public function weeklyCohorts()
    {
        $data = [];
        foreach ($this->getWeekGroups() as $key => $column) {
            $_weeklyData = [];
            $_weeklyData['name'] = $column->week_of_year . " Week ";
            foreach ([20, 40, 50, 70, 90, 99, 100] as $step) {
                $_weeklyData['data'][] = round(($this->getWeeklyStepProcessCount($column->week_of_year,
                            $step) / $column->user_count) * 100, 2);
            }
            $data[] = $_weeklyData;
        }
        return $data;
    }
}