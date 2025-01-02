<?php

use App\Models\Employer;
use App\Models\Job;

it('belongs to an employer', function () {
    // 3 STEPS PROCESS - AAA
    // Arrange, Act, Assert

    //Arrange - the world to be performed
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);
    //Act - the action
    //Assert - what expects to be happened
    expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function () {
    $job = Job::factory()->create();

    $job->tag('Frontend');

    expect(($job->tags))->toHaveCount(1);
});