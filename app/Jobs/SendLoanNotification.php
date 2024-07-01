<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\{Loan, User};

class SendLoanNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loan;
    protected $user;

    public function __construct(Loan $loan, User $user)
    {
        $this->loan = $loan;
        $this->user = $user;
    }

    public function handle()
    {
        // Envia email para o usuário
        Mail::to($this->user->email)
            ->send(new LoanNotification($this->loan));
    }
}
