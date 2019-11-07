<?php

namespace BrandStudio\Auth\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use BrandStudio\Auth\Models\VerificationToken;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $service;
    protected $token;

    public function __construct(string $service, VerificationToken $token)
    {
        $this->service = $service;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->service::send($this->token->login, trans('brandstudio::auth.your_code', ['code' => $this->token->token]));
    }
}
