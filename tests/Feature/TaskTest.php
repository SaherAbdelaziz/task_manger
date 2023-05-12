<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /** @test */
    public function an_auth_user_cant_access_tasks_create()
    {
        $user = User::factory()->create();
        $res = $this->actingAs($user)->get('/tasks/create');
        $res->assertStatus(302);
    }

    /** @test */
    public function an_admin_user_can_access_tasks_create()
    {
        $admin = User::factory()->admin()->create();
        $res = $this->actingAs($admin)->get('/tasks/create');
        $res->assertStatus(200);
    }


    /** @test */
    public function a_task_can_be_created_with_Admin()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);
    }

    /** @test */
    public function a_task_cant_be_created_with_User()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();
        $res = $this->actingAs($user)->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);

        $res->assertStatus(302);

    }

    /** @test */
    public function a_task_requires_a_title()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('tasks.store'), [
            'title' => '',
            'description' => 'This is a test task.',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_task_requires_a_description()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('tasks.store'), [
            'title' => 'Test Task',
            'description' => '',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);

        $response->assertSessionHasErrors('description');
    }
}
