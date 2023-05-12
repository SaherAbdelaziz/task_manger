<?php

namespace Tests\Feature;

use App\Models\Task;
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
    public function testTaskCanBeCreated()
    {
        // Create a new task using the model
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'assigned_to_id' => 1,
            'assigned_by_id' => 2,
        ]);

        // Assert that the task was created successfully
        $this->assertNotNull($task);
        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('This is a test task', $task->description);
        $this->assertEquals(1, $task->assigned_to_id);
        $this->assertEquals(2, $task->assigned_by_id);
    }
}
