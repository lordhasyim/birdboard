<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function only_authenticated_user_can_login()
    {
        // $this->withoutExceptionHandling();

        // $attributes = factory(Project::class)->raw([
        //     'owner_id' => null
        // ]);

        $attributes = factory(Project::class)->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function test_a_user_can_create_a_project()
    {
        $this->actingAs(factory(User::class)->create());

        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(factory(User::class)->create());
        
        $attributes = factory(Project::class)->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

}
