<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class UsersOnboarding extends Model {

    protected $table = 'users_onboarding';


    private function _getWeekGroups() {
        return $this->select(
            DB::raw("WEEK(created_at) as week_of_year"),
            DB::raw("count(user_id) as user_count")
        )->where('user_id','!=','0')->groupBy('week_of_year')->get();
    }

    private function _getWeeklyStepProccess($week_of_year,$step) {
        return $this->where('user_id','!=',0)
                ->where('onboarding_percentage','>=',$step)
                ->where(DB::raw('WEEK(created_at)'),'=',$week_of_year)->count();
    }

    /**
     * Get Weekly Cohorts
     *
     * @return array
     */
    public function weeklyCohorts(){

        $data = [];
        foreach ($this->_getWeekGroups() as $key => $column ) {
            $_weeklyData = [];
            $_weeklyData['name'] = $column->week_of_year." Week ";
            foreach ([20,40,50,70,90,99,100] as $step) {
                $_weeklyData['data'][] = round(($this->_getWeeklyStepProccess($column->week_of_year,$step) / $column->user_count ) * 100,2);
            }
            $data[] = $_weeklyData;
        }

        return $data;
    }



}
