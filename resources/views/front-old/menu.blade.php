    @php
        $pagemark = '';
        if(isset($title))
        {
            $pagemark = $title;  
        }
        
        $menufronttop = DB::select('select * from setting_menu where type="front_top" and status="active"');
    @endphp
    
    
    <ul class="navbar-nav p-3 p-lg-0 ms-lg-auto me-lg-4 me-xxl-5">

    @foreach ($menufronttop as $menu)
        <li class="nav-item">
            <a class="nav-link {{ $pagemark === $menu->menu_name ? 'active' : '' }}" id="nav{{ $menu->menu_name }}" href="{{ url('f'.$menu->menu_name) }}"
                onclick="$('#loading').collapse('show');">
                {{ $menu->menu_label }}
            </a>
        </li>
    @endforeach
    


</ul>
