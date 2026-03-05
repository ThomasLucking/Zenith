<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Laravel Todo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900 antialiased min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-800">Tasks</h1>
        </header>

        <form action="/tasks" method="POST" class="flex flex-col gap-3 mb-10">
            @csrf
            <input type="text" name="title" required placeholder="Title" class="w-full border-2 p-3 rounded-xl">
            <textarea name="description" rows="2" placeholder="Description"
                class="w-full border-2 p-3 rounded-xl"></textarea>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl">Add Task</button>
        </form>

        <ul class="space-y-4">
            @forelse ($tasks as $task)
                <li class="flex flex-col p-4 bg-slate-50 rounded-xl border border-slate-200 transition-all">
                    <div class="flex justify-between items-start">
                        <span
                            class="font-bold text-slate-700 {{ $task->is_completed ? 'line-through text-slate-400' : '' }}">
                            {{ $task->title }}
                        </span>

                        <div class="flex gap-4">
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="text-xs font-bold uppercase {{ $task->is_completed ? 'text-slate-400' : 'text-blue-600' }}">
                                    {{ $task->is_completed ? 'Undone' : 'Done' }}
                                </button>
                            </form>

                            {{-- Delete Form --}}
                            <form action="/tasks/{{ $task->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold uppercase text-red-500 hover:text-red-700"
                                    onclick="return confirm('Delete this task?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Only show description if it exists --}}
                    @if($task->description)
                        <p class="text-sm text-slate-500 mt-2 border-t border-slate-100 pt-2 italic">
                            {{ $task->description }}
                        </p>
                    @endif
                </li>
            @empty
                <div class="text-center py-10">
                    <p class="text-slate-400 italic">No tasks yet.</p>
                </div>
            @endforelse
        </ul>
    </div>
</body>

</html>