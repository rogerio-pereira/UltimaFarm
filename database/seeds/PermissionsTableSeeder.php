<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables =  [
                        'banners'               => 'banners',
                        'portfolios'            => 'portifólio',
                        'services'              => 'serviços',
                        'videos'                => 'videos',
                        'page_categories'       => 'categorias de paginas',
                        'pages'                 => 'páginas',
                        'product_categories'    => 'categorias de produto',
                        'product_subcategories' => 'subcategorias de produto',
                        'products'              => 'produtos',
                        'socialmedias'          => 'mídias sociais',
                        'faqs'                  => 'FAQs',
                        'depoiments'            => 'depoimentos',
                        'users'                 => 'usuários',
                        'permissions'           => 'permissões',
                        //Blog
                        'post_categories'       => 'categorias de posts',
                        'posts'                 => 'posts',
                        //Administrativo
                        'clients'               => 'clientes',
                        'sales'                 => 'vendas',
                        'comissions'             => 'vendas',
                        'refunds'               => 'reembolso',
                        //Empresa
                        'business_info'         => 'informações da empresa',
                        'address-categories'    => 'locais',
                        'addresses'             => 'endereços',
                        'telephones'            => 'telefones',
                        'emails'                => 'e-mails',
                    ];

        $permissions =  [
                            'view'      => 'Visualizar',
                            'create'    => 'Criar',
                            'update'    => 'Atualizar',
                            'delete'    => 'Apagar'
                        ];


        //Percorre as tabelas
        foreach($tables as $table => $tableDesc) {
            //Percorre as permissões
            foreach($permissions as $permission => $permissionDesc) {
                try {
                    //Cria permissão
                    Permission::create([
                                'name'          => $permission.'-'.$table,
                                'description'   => $permissionDesc.' '.$tableDesc  
                            ]);
                }
                catch(Exception $e)
                {}
            }
        }
    }
}
