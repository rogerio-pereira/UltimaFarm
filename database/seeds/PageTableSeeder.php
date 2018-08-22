<?php

use App\Models\Page;
use App\Models\PageCategory;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PageCategory::class)->create([
            'title' => 'Home',
        ]);

        factory(Page::class)->create([
            'title' => 'Investimento, Segurança e Taxas',
            'description' => 'Investimento, Segurança e Taxas', 
            'text' => "<div class='homeInfo'>
                        <div class='col-md-4'>
                            <div class='padding-left-g padding-right-g text-center'>
                                <img src='".env('APP_URL')."/img/cifrao.png' alt='Investimento garantido'>
                                <br/>
                                Investimento garantido<br/> pelo UFCC &<br/> Allstate Farm
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='padding-left-g padding-right-g text-center border-left border-right'>
                                <img src='".env('APP_URL')."/img/lampada.png' alt='Segurança'>
                                <br/>
                                A segurança de investimento do mercado americano a apenas um clique de alcance
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='padding-left-g padding-right-g text-center'>
                                <img src='".env('APP_URL')."/img/percento.png' alt='Taxas'>
                                <br/>
                                Taxas de rentabilidade pré-fixadas podendo chegar em até a 40% sobre o investido
                            </div>
                        </div>
                </div>", 
            'image' => null, 
            'page_category_id' => 1,
            'show_title' => false
        ]);

        factory(Page::class)->create([
            'title' => 'Investimento Privado de Cannabis para Investidores Credenciados',
            'description' => 'Investimento Privado de Cannabis para Investidores Credenciados', 
            'text' => "<p>A UFCC ajuda a fornecer cobertura sobre as melhores oportunidades de coloca&ccedil;&atilde;o privada e ofertas para investidores credenciados na ind&uacute;stria de Cannabis Medicinal. Trabalhamos apenas com investidores credenciados, visando a seguran&ccedil;a no processo de investimento.</p>
                <p>Ao invetir nesse segmento voc&ecirc; fomenta o desenvolvimento do mercado da Cannabis Medicinal e adquire t&iacute;tulos de rendimento semestral, com rendimentos pr&eacute;-fixados e ajustados de acordo com o valor investido.</p>
                <div class='text-center'>
                    <a href='#' class='btn btn-primary margin-top'>
                        Tabela de Rendimentos
                    </a>
                </div>", 
            'image' => env('APP_URL').'/img/investimento-privado.png', 
            'page_category_id' => 1,
            'show_title' => true
        ]);

        factory(Page::class)->create([
            'title' => 'Histórico Produtivo e Previsão de Produção',
            'description' => 'Histórico Produtivo e Previsão de Produção', 
            'text' => "<p>A UFCC est&aacute; em plena expans&atilde;o e apresenta resultados crescentes a cada nova safra. Sendo os &uacute;ltimos resultados obtidos:</p>
                <ul>
                <li>Outubro/2017 - Cerca de 500 Kg</li>
                <li>Dezembro/2017 - Cerca de 1200 Kg</li>
                <li>Fevereiro/2017 - Cerca de 2400 Kg</li>
                </ul>
                <p>Crescimento de 200% de produ&ccedil;&atilde;o nos &uacute;ltimos 3 ciclos (m&eacute;dia de 6 meses), realizados no estado da Calif&oacute;rnia. A produ&ccedil;&atilde;o dos pr&oacute;ximos ciclos possuem expectativa de crescimento m&eacute;dio de 108,34% com base nos investimentos realizados e devido a transfer&ecirc;ncia da produ&ccedil;&atilde;o para o estado do Texas. Chegando a m&eacute;dia de 5000 Kg e com previs&atilde;o de 10.000 Kg para o ciclo de Novembro/2018.</p>", 
            'image' => env('APP_URL').'/img/historico-produtivo.png', 
            'page_category_id' => 1,
            'show_title' => true
        ]);

        factory(Page::class)->create([
            'title' => 'Processos de Avaliação e Controle',
            'description' => 'Processos de Avaliação e Controle', 
            'text' => "<p>A nossa produ&ccedil;&atilde;o passa por rigorosos processos de avalia&ccedil;&atilde;o e controle. Com o objetivo de zelar pela qualidade, produtividade e tamb&eacute;m gerar mais seguran&ccedil;a ao investidor desse mercado privado.</p>
                <p>A busca por melhoria constante &eacute; um dos principais objetivos, pois assim iremos gerar mais rentabilidade e com mais efic&aacute;cia. Por esse motivo, mesmo sendo uma empresa do mercado privado, somos acompanhados pela industria farmac&ecirc;utica, passando por rigorosos controles exigidos pela BAYER ALEM&Atilde;.</p>", 
            'image' => env('APP_URL').'/img/bayer.png', 
            'page_category_id' => 1,
            'show_title' => true
        ]);

        factory(PageCategory::class)->create([
            'title' => 'Empresa',
        ]);

        factory(PageCategory::class)->create([
            'title' => 'Investimentos',
        ]);

        factory(Page::class)->create([
            'title' => 'Informações',
            'description' => 'Informações', 
            'text' => "
                    <div class='row'>
                        <div class='col-md-4'>
                            <div class='investmentIcon'>
                                <div class='row margin-top margin-bottom padding-left padding-right'>
                                    <div class='col-xs-4'>
                                        <img src='".env('APP_URL')."/img/investimento-cifrao.png' alt='Investimentos' class='img-responsive'>
                                    </div>
                                    
                                    <div class='col-xs-8 text-right'>
                                        <h2>Investimentos a partir de</h2>
                                    </div>
                                </div>

                                <div class='col-xs-12 text-center investmentIconFooter'>
                                    <h1>R$ 500,00</h1>
                                </div>
                            </div>
                        </div>
                        
                        <div class='col-md-4'>
                            <div class='investmentIcon'>
                                <div class='row margin-top margin-bottom padding-left padding-right'>
                                    <div class='col-xs-4'>
                                        <img src='".env('APP_URL')."/img/investimento-rendimento-mensal.png' alt='Rendimento Mensal' class='img-responsive'>
                                    </div>
                                    
                                    <div class='col-xs-8 text-right'>
                                        <h2>Titulos de resgate semestral com</h2>
                                    </div>
                                </div>

                                <div class='col-xs-12 text-center investmentIconFooter'>
                                    <h1>Rendimento Mensal</h1>
                                </div>
                            </div>
                        </div>
                        
                        <div class='col-md-4'>
                            <div class='investmentIcon'>
                                <div class='row margin-top margin-bottom padding-left padding-right'>
                                    <div class='col-xs-4'>
                                        <img src='".env('APP_URL')."/img/investimento-taxas.png' alt='Taxas' class='img-responsive'>
                                    </div>
                                    
                                    <div class='col-xs-8 text-right'>
                                        <h2>Taxas de rendimento de até</h2>
                                    </div>
                                </div>

                                <div class='col-xs-12 text-center investmentIconFooter'>
                                    <h1>40% a.m.</h1>
                                </div>
                            </div>
                        </div>
                        
                        <div class='col-md-4'>
                            <div class='investmentIcon'>
                                <div class='row margin-top margin-bottom padding-left padding-right'>
                                    <div class='col-xs-4'>
                                        <img src='".env('APP_URL')."/img/investimento-bandeira.png' alt='Mercado Americano' class='img-responsive'>
                                    </div>
                                    
                                    <div class='col-xs-8 text-right'>
                                        <h2>Segurança e maturidade do</h2>
                                    </div>
                                </div>

                                <div class='col-xs-12 text-center investmentIconFooter'>
                                    <h1>Mercado Americano</h1>
                                </div>
                            </div>
                        </div>
                        
                        <div class='col-md-4'>
                            <div class='investmentIcon'>
                                <div class='row margin-top margin-bottom padding-left padding-right'>
                                    <div class='col-xs-4'>
                                        <img src='".env('APP_URL')."/img/investimento-bayer.png' alt='Bayer - Indústria Farmaceutica' class='img-responsive'>
                                    </div>
                                    
                                    <div class='col-xs-8 text-right'>
                                        <h2>Desenvolva a indústria</h2>
                                    </div>
                                </div>

                                <div class='col-xs-12 text-center investmentIconFooter'>
                                    <h1>Farmaceutica</h1>
                                </div>
                            </div>
                        </div>
                        
                        <div class='col-md-4'>
                            <div class='investmentIcon'>
                                <div class='row margin-top margin-bottom padding-left padding-right'>
                                    <div class='col-xs-4'>
                                        <img src='".env('APP_URL')."/img/investimento-mercado-financeiro.png' alt='Mercado Financeiro' class='img-responsive'>
                                    </div>
                                    
                                    <div class='col-xs-8 text-right'>
                                        <h2>Antecipe tendências do</h2>
                                    </div>
                                </div>

                                <div class='col-xs-12 text-center investmentIconFooter'>
                                    <h1>Mercado Financeiro</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                ", 
            'image' => env('APP_URL').'/img/template/sem-imagem.jpg', 
            'page_category_id' => 3,
            'show_title' => false
        ]);

        /*
            factory(Page::class)->create([
                'title' => '',
                'description' => '', 
                'text' => "", 
                'image' => env('APP_URL').'/img/_IMAGEM_.png', 
                'page_category_id' => _CATEGORIA_,
                'show_title' => true_false
            ]);
         */
    }
}
