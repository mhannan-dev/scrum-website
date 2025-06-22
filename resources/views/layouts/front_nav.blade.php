<nav class="main-nav">
    <!-- ***** Logo Start ***** -->
    <a href="{{ url('/') }}" class="logo">
        <!-- <h1>Global Experts</h1> -->
        <img src="{{ asset('frontend/assets/images/logo.png') }}" style="width:90px" alt="">
    </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Serach Start ***** -->
    <div class="search-input" style="width:100%; margin-top:25px;margin-left:10px;">
        <h3 style="color: #fff;">Global Experts Ltd.</h3>
        <!-- <form id="search" action="#">
                                <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword"
                                    onkeypress="handle" />
                                <i class="fa fa-search"></i>
                            </form> -->
    </div>
    <!-- ***** Serach Start ***** -->
    <!-- ***** Menu Start ***** -->
    <ul class="nav">
        <li class="scroll-to-section">
            <a href="{{ @$page_name !== 'home' ? url('/') : '#top' }}"
                class="{{ @$page_name === 'home' ? 'active' : '' }}">Home</a>
        </li>
        <li class="scroll-to-section"><a href="{{ @$page_name === 'home' ? '#courses' : url('/#courses') }}">Courses</a>
        </li>
        <li class="scroll-to-section"><a href="{{ @$page_name === 'home' ? '#team' : url('/#team') }}">Team</a></li>
        <li class="scroll-to-section"><a href="{{ @$page_name === 'home' ? '#events' : url('/#events') }}">Batch</a>
        </li>
        <li class="scroll-to-section"><a href="{{ @$page_name === 'home' ? '#contact' : url('/#contact') }}">Register
                Now!</a></li>
    </ul>

    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
    <!-- ***** Menu End ***** -->
</nav>
