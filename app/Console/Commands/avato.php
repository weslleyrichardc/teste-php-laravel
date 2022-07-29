<?php

namespace App\Console\Commands;

use App\Models\Hash;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class avato extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avato:test
                            {string : String que vai ser usada nas requisições.}
                            {--requests=10 : Quantidade de requisições que devem ser feitas.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Faz --requests requisições enviando a string informada.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $batch = now();
        $string = $this->argument('string');
        $requests = $this->option('requests');

        $this->line("Batch: $batch\tString: $string\tRequests: $requests");

        $this->newLine();
        for ($requestCounter = 1; $requestCounter <= $requests; $requestCounter++) {
            $string = $this->createHash($batch, $requestCounter, $string);

            if ($string === null) {
                return 0;
            }
        }

        return 0;
    }

    /**
     * @param Carbon $batch
     * @param int $requestCounter
     * @param string|null $string
     * @return mixed
     */
    public function createHash(Carbon $batch, int $requestCounter, string|null $string): mixed
    {
        $response = Http::post(route('hash.create'), ['string' => $string]);

        $status = $response->status();
        if ($status == Response::HTTP_TOO_MANY_REQUESTS) {
            $this->line("Block: $requestCounter\tString: $string\t$status: Too Many Attempts");

            return null;
        }

        $data = json_decode($response->body('hash'));

        Hash::create([
            "batch" => $batch,
            "block" => $requestCounter,
            "string" => $string,
            "key" => $data->key,
            "hash" => $data->hash,
            "tries" => 1,
        ]);

        $this->line("Block: $requestCounter\tString: $string\t$status: OK");

        return $data->hash;
    }
}
