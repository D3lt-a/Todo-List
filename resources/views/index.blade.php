<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3490dc;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #2779bd;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #f9fafb;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .completed {
            text-decoration: line-through;
            color: gray;
        }

        .actions form {
            display: inline;
        }

        .actions button {
            background-color: #10b981;
            margin-left: 5px;
        }

        .actions .delete-btn {
            background-color: #ef4444;
        }

        .actions button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>📝 My Todo List</h1>

        <!-- Task Form -->
        <form action="/tasks" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Add new task...">
            <button type="submit">Add</button>
        </form>

        <!-- Task List -->
        <ul>
            @forelse ($tasks as $task)
                <li>
                    <span class="{{ $task->completed ? 'completed' : '' }}">
                        {{ $task->title }}
                    </span>

                    <div class="actions">
                        <!-- Mark Complete/Undo -->
                        <form action="/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button>{{ $task->completed ? 'Undo' : 'Done' }}</button>
                        </form>

                        <!-- Delete -->
                        <form action="/tasks/{{ $task->id }}" method="POST" onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn">Delete</button>
                        </form>
                    </div>
                </li>
            @empty
                <li style="text-align: center; color: #666;">No tasks found.</li>
            @endforelse
        </ul>
    </div>

</body>
</html>
