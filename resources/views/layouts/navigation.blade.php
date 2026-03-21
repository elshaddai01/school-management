<nav class="bg-blue-900 text-white px-6 py-4">
    <div class="flex justify-between items-center">

        <!-- Left: App name + nav links -->
        <div class="flex items-center gap-8">
            <span class="font-bold text-lg tracking-wide">
                School Management System
            </span>

            @auth
                @if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}"
       class="text-sm text-blue-200 hover:text-white">Dashboard</a>
    <a href="{{ route('admin.classes.index') }}"
       class="text-sm text-blue-200 hover:text-white">Classes</a>
    <a href="{{ route('admin.students.index') }}"
       class="text-sm text-blue-200 hover:text-white">Students</a>
    <a href="{{ route('admin.subjects.index') }}"
       class="text-sm text-blue-200 hover:text-white">Subjects</a>
@else
                    <a href="{{ route('teacher.dashboard') }}"
                       class="text-sm text-blue-200 hover:text-white">
                        Dashboard
                    </a>
                @endif
            @endauth
        </div>

        <!-- Right: username + logout -->
        @auth
        <div class="flex items-center gap-4">
            <span class="text-sm text-blue-200">
                {{ auth()->user()->name }}
                <span class="ml-1 text-xs bg-blue-700 px-2 py-0.5 rounded">
                    {{ auth()->user()->role }}
                </span>
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-sm bg-blue-700 hover:bg-blue-600
                           px-4 py-1 rounded transition">
                    Logout
                </button>
            </form>
        </div>
        @endauth

    </div>
</nav>