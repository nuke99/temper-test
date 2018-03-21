<?php

namespace Tests\Feature;


use App\User;
use App\UsersOnboarding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UsersOnBoardingTest extends TestCase
{
    use RefreshDatabase;


    private $model;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->model = new UsersOnboarding;
    }

    /**
     * Create Single user to check writable permissions
     */
    public function testCreateOnBoardingSteps()
    {
        $onBoarding = factory(UsersOnboarding::class, 3)->create();
        $this->assertEquals(3, $onBoarding->count());
    }

    /**
     * Test Weekly Group Function
     */
    public function testWeekGroups()
    {
        factory(UsersOnboarding::class)->create([
            'user_id' => 3121,
            'created_at' => '2016-07-19',
            'onboarding_percentage' => 40,
            'count_applications' => 0,
            'count_accepted_applications' => 0
        ]);

        $attributes = $this->model->getWeekGroups()->first()->getAttributes();
        $this->assertEquals(2, sizeof($attributes));
        $this->assertArrayHasKey('week_of_year', $attributes);
        $this->assertArrayHasKey('user_count', $attributes);
    }


    /**
     *
     * Test Weekly Step Process
     */
    public function testGetWeeklyStepProcess()
    {
        factory(UsersOnboarding::class)->create([
            'user_id' => 3121,
            'created_at' => '2016-07-19',
            'onboarding_percentage' => 40,
            'count_applications' => 0,
            'count_accepted_applications' => 0
        ]);

        $week = 29;
        $step = 0;
        $resultCount = $this->model->getWeeklyStepProcessCount($week, $step);

        $this->assertEquals(true, is_int($resultCount));
        $this->assertEquals(1,$resultCount);
    }


    /**
     * Test Weekly Cohorts
     */
    public function testWeeklyCohorts()
    {
        factory(UsersOnboarding::class)->create([
            'user_id' => 3121,
            'created_at' => '2016-07-19',
            'onboarding_percentage' => 40,
            'count_applications' => 0,
            'count_accepted_applications' => 0
        ]);

        $resultsArray = $this->model->weeklyCohorts();

        $this->assertEquals(true, is_array($resultsArray));
        if (sizeof($resultsArray) > 0) {
            $result = $resultsArray[0];
            $this->assertEquals(2, sizeof($result));
            $this->assertArrayHasKey('name', $result);
            $this->assertArrayHasKey('data', $result);
        }
    }
}
