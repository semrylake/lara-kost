<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if($status == "on")
                @else
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/home" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu ml-1">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/regulation"
                        aria-expanded="false">
                        <i class="mdi mdi-account-alert"></i>
                        <span class="hide-menu ml-1" data-toggle="tooltip" data-placement="right"
                            title="Buat rule atau peraturan yang diterapkan di tempat Anda.">Peraturan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/facility" aria-expanded="false">
                        <i class=" fas fa-clipboard-list"></i>
                        <span class="hide-menu ml-1" data-toggle="tooltip" data-placement="right"
                            title="Buat rule atau peraturan yang diterapkan di tempat Anda.">Fasilitas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/room" aria-expanded="false">
                        <i class="mdi mdi-glassdoor"></i> Kamar
                    </a>
                </li>
                @endif
            </ul>
        </nav>

    </div>

</aside>
