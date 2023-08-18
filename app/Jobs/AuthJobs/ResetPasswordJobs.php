<?php

namespace App\Jobs\AuthJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\ResetPasswordNotification;
use App\Models\user;
class ResetPasswordJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $token;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,String $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
        $this->user->notify(new ResetPasswordNotification($this->token));
    }
}
