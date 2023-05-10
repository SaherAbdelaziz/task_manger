<?php

namespace App\Jobs;

use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info('Updating statistics...');
        $users = User::all();

        foreach ($users as $user) {
            $count = Task::where('assigned_to_id', $user->id)->count();

            $statistic = Statistics::firstOrCreate(
                ['user_id' => $user->id],
                ['count' => $count]
            );

            $statistic->count = $count;
            $statistic->save();
        }
    }
}
