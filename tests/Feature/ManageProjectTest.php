<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_manage_projects()
    {
        // $this->withoutExceptionHandling();
 
        // $attributes = factory(Project::class)->raw([
        //     'owner_id' => null
        // ]);

        // $attributes = factory(Project::class)->raw();
        $project = factory(Project::class)->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');


    }

    /** @test */
    // public function guest_cannot_view_projects()
    // {

    //     $this->get('/projects')->assertRedirect('login');
    // }

    // /** @test */
    // public function guest_cannot_view_a_single_project()
    // {
    //     $project = factory(Project::class)->create();

    //     $this->get($project->path())->assertRedirect('login');
    // }

    /** @test */
    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());
        
        $this->get('/projects/create')->assertStatus(200);


        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->be(factory('App\User')->create());
        
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create([
            'owner_id' => auth()->id()
        ]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->be(factory('App\User')->create());
        
        // $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);

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
