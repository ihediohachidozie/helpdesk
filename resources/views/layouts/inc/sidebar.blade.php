<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
            <div class="profile-image">
                <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="profile image">
                <div class="dot-indicator bg-success"></div>
            </div>
            <div class="text-wrapper">
                <p class="profile-name">{{auth()->user()->name}}</p>
                <p class="designation">Helpdesk Agent </p>
            </div>
            </a>
        </li>
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
            <router-link to="/home" class="nav-link">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
            
            </router-link>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon typcn typcn-coffee"></i>
            <span class="menu-title">Inventory</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <router-link to="/home/customer" class="nav-link">Customer</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/home/department" class="nav-link">Department</router-link>
            
                </li>
                <li class="nav-item">
                    <router-link to="/home/device" class="nav-link">Hardware</router-link>
            
                </li>
                <li class="nav-item">
                    <router-link to="/home/software" class="nav-link">Software</router-link>
            
                </li>

                <li class="nav-item">
                    <router-link to="/home/issueCategory" class="nav-link">Issue Category</router-link>
            
                </li>
            </ul>
            </div>
        </li>
        <li class="nav-item">
            <router-link to="/home/ticket" class="nav-link">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Ticket</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/home/search" class="nav-link">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Knowledge Base</span>
            </router-link>
        </li>
    </ul>
</nav>