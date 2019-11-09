<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use RequestModel;

class RequestsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'requests:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Requests that be sended weekly';

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
     * @return mixed
     */
    public function handle()
    {
        $requestModel = new RequestModel();
		
		$requestModel->user_id = 11;
		
		$requestModel->project_id = 3;
		
		$requestModel->title = 'Planilha Quiz';
		
		$requestModel->description = 'Vocês poderiam nos enviar a planilha atualizada referente aos quizzes da disciplina de Computação Afetiva, por favor?';
		
		$requestModel->technician_id = 4;
		
		$requestModel->type = 'pedido';
		
		$requestModel->priority = 'menor';
		
		$requestModel->deadline = date('d/m/Y', strtotime('+2 days'));
		
		$requestModel->status = 'a fazer';
		
		$requestModel->save();
    }
}
