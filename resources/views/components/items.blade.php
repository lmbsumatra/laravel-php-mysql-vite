<ul class="flex flex-col md:flex-row px-4">
    @auth
    <li>
        <a href="/add/student" class="block pr-4 pl-3">Add New</a>
    </li>
        <li>
            <form action="/logout" method="POST">
                @csrf
                <button href="/logout" class="block pr-4 pl-3">Logout</button>
            </form>
        </li>
    @else
        <li>
            <a href="/login" class="block pr-4 pl-3">Sign in</a>
        </li>
        <li>
            <a href="/register" class="block pr-4 pl-3">Sign up</a>
        </li>
    @endauth
</ul>
