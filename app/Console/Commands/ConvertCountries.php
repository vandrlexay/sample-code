<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Converter\Converter;

class ConvertCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:countries {--input-file=} {--output-file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert country file to another format';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input  = $this->option('input-file');
        $output = $this->option('output-file');

        if (!file_exists($input))
            throw new \Exception("$input does not exist");

        $inputFormat = strtolower(pathinfo($input)["extension"]);
        $outputFormat = strtolower(pathinfo($output)["extension"]);

        $c = new Converter();
        $transfer = $c->load($input, $inputFormat);
        $saved = $c->save($transfer, $outputFormat);

        file_put_contents($output, $saved);
        
        return 0;
    }
}
