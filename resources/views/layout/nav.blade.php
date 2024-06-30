<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hii, {{ auth()->user()->name }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link " href="{{ route('users') }}">Manage User</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="{{ route('manageRole') }}">Manage Role</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="{{ route('managePermission') }}">Manage Permission</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="{{ route('assignPermissionRole') }}">Assign  Permission To Role </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="{{ route('assignPermissionRoute') }}">Assign  Permission To Route </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link logout-user" style="cursor: pointer"> logout</a>
        </li>

      </ul>

    </div>
  </nav>
