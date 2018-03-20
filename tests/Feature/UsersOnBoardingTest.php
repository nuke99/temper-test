<?php

namespace Tests\Feature;


use App\UsersOnboarding;
use Tests\TestCase;


class UsersOnBoardingTest extends TestCase
{
    //moved RefreshDatabase to Parent Class


    private $model;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = new UsersOnboarding;
    }

    /**
     * Create Single user to check writable permissions
     */
    public function testCreateSingleUser()
    {
        $this->artisan('migrate:reset');
        $this->artisan('migrate');
        $this->model->user_id = 3121;
        $this->model->created_at = '2016-07-19';
        $this->model->onboarding_percentage = 100;
        $this->model->count_applications = 0;
        $this->model->count_accepted_applications = 0;
        $this->model->save();
        $this->assertEquals(1, $this->model->count());
    }

    /**
     * Test Weekly Group Function
     */
    public function testWeekGroups()
    {

        $result_array = $this->model->getWeekGroups()->first()->toArray();

        $this->assertEquals(2, sizeof($result_array));
        $this->assertArrayHasKey('week_of_year', $result_array);
        $this->assertArrayHasKey('user_count', $result_array);
        $this->assertEquals(true,is_int($result_array['user_count']));
        $this->assertEquals(true,is_int($result_array['week_of_year']));
    }


    /**
     *
     * Test Weekly Step Process
     */
    public function testGetWeeklyStepProcess()
    {
        $week = 29; // based on seed data
        $step = 0; // based on seed data
        $result = $this->model->getWeeklyStepProcess($week, $step);
        $this->assertEquals(true, is_int($result)); // returns count (int)
    }


    /**
     * Test Weekly Cohorts
     */
    public function testWeeklyCohorts()
    {
        $results = $this->model->weeklyCohorts();

        $this->assertEquals(true, is_array($results));

        if (sizeof($results) > 0) {
            $result = $results[0];
            $this->assertEquals(2, sizeof($result));
            $this->assertArrayHasKey('name', $result);
            $this->assertArrayHasKey('data', $result);
            $this->assertEquals(true, is_array($result['data']));
            $this->assertEquals(true, is_string($result['name']));
        }
    }


}
