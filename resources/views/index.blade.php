<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { margin-bottom: 20px; }
        .task { margin-bottom: 10px; }
        .completed { text-decoration: line-through; color: gray; }
    </style>
</head>
<body>
    <h1>Todo List</h1>

    <!-- Create New Task -->
    <form method="POST" action="/tasks">
        @csrf
        <input type="text" name="title" placeholder="New task">
        <button type="submit">Add</button>
    </form>

    <!-- Task List -->
    @foreach($tasks as $task)
        <div class="task">
            <form method="POST" action="/tasks/{{ $task->id }}" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="submit">{{ $task->completed ? 'Undo' : 'Complete' }}</button>
            </form>

            <span class="{{ $task->completed ? 'completed' : '' }}">{{ $task->title }}</span>

            <form method="POST" action="/tasks/{{ $task->id }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach
</body>
</html>
