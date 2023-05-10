<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_can_be_created()
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($admin)->post(route('tasks.store'), [
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
        $this->assertDatabaseCount('tasks', 0);
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
        $this->assertDatabaseCount('tasks', 0);
    }
}
