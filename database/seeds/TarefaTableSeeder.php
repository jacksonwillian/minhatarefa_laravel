<?php

use Illuminate\Database\Seeder;
use App\Models\Tarefa;

class TarefaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarefa::create([
            'titulo' => 'Tarefa de Teste',
            'prioridade' => 'alta',
            'situacao' => 'concluido',
            'descricao' => 'Tarefa de teste'
        ]);
    }
}
