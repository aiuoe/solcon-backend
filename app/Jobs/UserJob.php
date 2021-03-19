<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $relp_id, $language_id, $name, $lastname, $email, $password, $refd, $org_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserRequest $request)
    {
        $this->relp_id = $request->relp_id;
        $this->org_id = $request->org_id;
        $this->language_id = $request->language_id;
        $this->name = strtolower($request->name);
        $this->lastname = strtolower($request->lastname);
        $this->email = strtolower($request->email);
        $this->password = bcrypt($request->password);
        $this->refd = $request->refd;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::create([
            'relp_id' => $this->relp_id,
            'language_id' => $this->language_id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
            'refd' => $this->refd,
            'org_id' => $this->org_id,
        ]);
        // ->emails()
        // ->create(["email_alt" => $this->email]);

        return response()->json(["message" => "success"], 200);
    }
}
