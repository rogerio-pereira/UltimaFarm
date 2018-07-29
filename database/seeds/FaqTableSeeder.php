<?php

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(Faq::class)->create([
        'question' => 'Existe algum fundo garantidor de crédito? Se sim, até qual valor?',
        'answer' => '<p>Sim! O fundo chama-se UFCC & Allstate Farm, o valor para a cobertura de investimentos externos (all World) é de U$10.000.000,00.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'Classifica como investimento em comodities?',
        'answer' => '<p>Sim, se encaixa como commodities financeira privadas.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'A taxa de rendimento é pré ou pós fixada?',
        'answer' => '<p>A taxa é de rendimentos pré fixadas, pois, na aquisição já temos o valor final do rendimento.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'A taxa é fixa ou flutuante?',
        'answer' => '<p>A taxa é fixa! Independente de qualquer índice.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'Sofre influência de câmbio?',
        'answer' => '<p>Como trabalhamos com um fator que nos dá garantia de cobertura, não temos influência do câmbio na divisão Brasil, talvez no próximo mercado que será o Europeu teremos de diversificar.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'A relação de Risco X Investimento é calculada? Se sim, qual é o índice?',
        'answer' => '<p>Sim, calculamos estabilidade do mercado financeiro americano + crescimento do setor de produção + produção pré negociada com indústria farmacêutica + fundo de segurado + patente de negociações de títulos cannabis nos dá incríveis 0,05% de risco, fazendo de nosso grupo um sólido grupo para se investir.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'Existe um histórico de produção e projeção de mercado?',
        'answer' => '<p>Sim, temos esse histórico, que foi iniciado em Outubro de 2017, ciclo concluído em Janeiro de 2018, com a produção de 1500 pounds (em torno de 450 g por pound) algo em torno de 800 Kg por ciclo, já no segundo ciclo iniciado em Dezembro de 2017 a Março de 2018 um crescimento de 50% obtivemos a produção de 1200 kg, de Fevereiro de 2018 a Maio de 2018 tivemos um crescimento significativo de 100% da última safra, chegando a 2400 Kg essas três primeiras foram realizadas no estado da Califórnia e só então movemos para o Texas trazendo conosco a maior produção aguardada até agora com 5000 Kg, a projeção de mercado após o início da comercialização dos títulos será para 10.000 Kg no próximo ciclo Agosto a Novembro 2018.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'Qual será o título recebido pelo investidor? (Carta de crédito, título numerado...) Terá regulação em algum órgão?',
        'answer' => '<p>Será título numerado, a princípio não há um órgão regulamentador para esse tipo de transação, mas existe um projeto para a legalização do plantio no Brasil em 2020 e então provavelmente teremos um órgão regulamentador nesse setor.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'A fazenda possui certificações (ISO e variantes)?',
        'answer' => '<p>Não, o que existe é um controle privado feito pela indústria farmacêutica, a Bayer alemã.</p>',
    ]);

    factory(Faq::class)->create([
        'question' => 'Os títulos possuem qual liquidez? O rendimento pode variar com o tempo do dinheiro investido? Se precisar resgatar antes o valor, poderá ser feito? Sofrerá com multas e descontos?',
        'answer' => '<p>A liquidez é um ponto a ser trabalhado  pois como abrimos mão de seguir varios indexadores a liquidez passou a ser exclusivamente na data prevista em contrato.</p>
            <p>Com o ciclo de tempo se tivermos investidores que queiram investir por dois ciclos como 1 ano direto todas as taxas de rendimentos tem um aumento do dobro.</p>
            <p>O resgate só poderá ser feito no prazo acordado em contrato, o titular pode transferir nesse caso o título para outra pessoa, mas os valores de resgate somente na data base, para que possamos seguir segurados pelo fundo de cobertura do investimento.</p>',
    ]);
  }
}
