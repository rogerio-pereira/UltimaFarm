@if(Auth::user()->role != 'Cliente') 
    {{--Administrativo--}}
    <li class='dropdown'>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Administrativo <span class="caret"></span>
        </a>

        <ul class="dropdown-menu inverse-dropdown" role="menu">
            {{--CLIENTS--}}
            @can('view-clients')
                <li>
                    <a href='{{route('clients.index')}}' alt='Clientes' title='Clientes'>
                        <i class="fa fa-users" aria-hidden="true"></i> Clientes
                    </a>
                </li>
            @endcan
            {{--SALES--}}
            @can('view-sales')
                <li>
                    <a href='{{route('sales.index')}}' alt='Vendas' title='Vendas'>
                        <i class="fa fa-money" aria-hidden="true"></i> Vendas
                    </a>
                </li>
            @endcan
        </ul>
    </li>

    {{--Cadastrar--}}
    <li class='dropdown'>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Cadastrar <span class="caret"></span>
        </a>

        <ul class="dropdown-menu inverse-dropdown" role="menu">
            {{--PAGE_CATEGORIES--}}
            @can('view-page_categories')
                <li>
                    <a href='{{route('page_categories.index')}}' alt='Categorias Páginas' title='Categorias Páginas'>
                        <i class="fa fa-list" aria-hidden="true"></i> Categorias Páginas
                    </a>
                </li>
            @endcan
            {{--PÁGINAS--}}
            @can('view-pages')
                <li>
                    <a href='{{route('pages.index')}}' alt='Páginas' title='Páginas'>
                        <i class="fa fa-file-text" aria-hidden="true"></i> Páginas
                    </a>
                </li>
            @endcan
            {{--BANNERS--}}
            @can('view-banners')
                <li>
                    <a href='{{route('banners.index')}}' alt='Banners' title='Banners'>
                        <i class="fa fa-picture-o" aria-hidden="true"></i> Banners
                    </a>
                </li>
            @endcan
            {{--PORTFOLIO--}}
            {{--@can('view-portfolios')
                <li>
                    <a href='{{url('/portfolios')}}' alt='Portifólios' title='Portifólios'>
                        <i class="fa fa-camera" aria-hidden="true"></i> Portifólios
                    </a>
                </li>
            @endcan--}}
            {{--SERVICES--}}
            {{--@can('view-services')
                <li>
                    <a href='{{route('services.index')}}' alt='Serviços' title='Serviços'>
                        <i class="fa fa-wrench" aria-hidden="true"></i> Serviços
                    </a>
                </li>
            @endcan--}}
            {{--VIDEOS--}}
            @can('view-videos')
                <li>
                    <a href='{{route('videos.index')}}' alt='Videos' title='Videos'>
                        <i class="fa fa-video-camera" aria-hidden="true"></i> Videos
                    </a>
                </li>
            @endcan
            {{--PRODUCT CATEGORY--}}
            {{--@can('view-product-categories')
                <li>
                    <a href='{{route('product_categories.index')}}' alt='Categorias de Produtos' title='Categorias de Produtos'>
                        <i class="fa fa-list" aria-hidden="true"></i> Categorias de Produtos
                    </a>
                </li>
            @endcan--}}
            {{--PRODUCT SUBCATEGORY--}}
            {{--@can('view-product-subcategories')
                <li>
                    <a href='{{route('product_subcategories.index')}}' alt='Subcategoria de Produtos' title='Subcategoria de Produtos'>
                        <i class="fa fa-list" aria-hidden="true"></i> Subcategoria de Produtos
                    </a>
                </li>
            @endcan--}}
            {{--PRODUCT--}}
            @can('view-products')
                <li>
                    <a href='{{route('products.index')}}' alt='Produtos' title='Produtos'>
                        <i class="fa fa-tags" aria-hidden="true"></i> Produtos
                    </a>
                </li>
            @endcan
            {{--SOCIAL MEDIA--}}
            @can('view-socialmedias')
                <li>
                    <a href='{{route('socialmedias.index')}}' alt='Mídias Socials' title='Mídias Socials'>
                        <i class="fa fa-facebook-square" aria-hidden="true"></i> Mídias Socials
                    </a>
                </li>
            @endcan
            {{--FAQ--}}
            @can('view-faqs')
                <li>
                    <a href='{{route('faqs.index')}}' alt='FAQ' title='FAQ'>
                        <i class="fa fa-asterisk" aria-hidden="true"></i> FAQ
                    </a>
                </li>
            @endcan
            {{--DEPOIMENT--}}
            @can('view-depoiment')
                <li>
                    <a href='{{route('depoiments.index')}}' alt='Depoimentos' title='Depoimentos'>
                        <i class="fa fa-comments" aria-hidden="true"></i> Depoimentos
                    </a>
                </li>
            @endcan
            {{--Users--}}
            @can('view-users')
                <li>
                    <a href='{{route('users.index')}}' alt='Usuários' title='Usuários'>
                        <i class="fa fa-user" aria-hidden="true"></i> Usuários
                    </a>
                </li>
            @endcan
        </ul>
    </li>

    {{--Blog--}}
    <li class='dropdown'>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Blog <span class="caret"></span>
        </a>

        <ul class="dropdown-menu inverse-dropdown" role="menu">
            {{--POST_CATEGORIES--}}
            @can('view-post_categories')
                <li>
                    <a href='{{route('post_categories.index')}}' alt='Categorias Post' title='Categorias Post'>
                        <i class="fa fa-list" aria-hidden="true"></i> Categorias Post
                    </a>
                </li>
            @endcan
            {{--POSTS--}}
            @can('view-posts')
                <li>
                    <a href='{{url('/posts')}}' title='Posts' alt='Posts' title='Posts'>
                        <i class="fa fa-file-text"></i> Posts
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif

{{--Usuário--}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu inverse-dropdown" role="menu">
        {{--Meus dados--}}
        <li>
            <a href='{{url('/users/'.Auth::user()->id.'/edit')}}' alt='Meus dados' title='Meus dados'>
                <i class="fa fa-user" aria-hidden="true"></i> Meus dados
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="fa fa-ban" aria-hidden="true"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>