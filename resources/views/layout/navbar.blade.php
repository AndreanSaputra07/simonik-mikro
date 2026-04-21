<nav class="navbar navbar-expand-lg bg-white shadow-sm px-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
    <img src="{{ asset('assets/mandiri.png') }}" class="logo-navbar">
</a>

        <div class="d-flex align-items-center">
            <span class="me-3 text-muted">
                {{ auth()->user()->name }}
            </span>

            <form action="/logout" method="POST">
                @csrf
                <button class="btn btn-sm btn-warning">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
