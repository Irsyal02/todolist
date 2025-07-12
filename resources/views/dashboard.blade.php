<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="pt-6 px-6 pb-3 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <p class="text-2xl text-bold">Your List</p>
                    <button
                        onclick="document.getElementById('add-task-form').classList.toggle('hidden')"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                    >
                        Add List
                    </button>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="text-green-500 font-semibold mb-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="bg-gray-600 overflow-hidden shadow-sm rounded-lg mb-3 p-3 hidden" id="add-task-form">
                        <form method="POST" action="{{ route('tasks.store') }}" class="flex h">
                            @csrf
                            <input type="text" name="title" placeholder="Make a list" class="w-full me-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <button type="submit" class="bg-gray-900 px-3 rounded-md border-gray-300">Add</button>
                        </form>
                    </div>
                    @foreach ($tasks as $task)
                        <div class="bg-gray-600 overflow-hidden flex shadow-sm rounded-lg  items-center text-lg min-h-14 mb-3 px-4 py-2">
                                <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex gap-2">
                                        <x-text-input class="w-full py-2" type="text" name="title" :value="$task->title" />
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}" class="m-3">
                                    @csrf
                                    @method('PATCH')
                                    <button class="px-3 py-2 rounded-md min-w-40 text-white {{ $task->is_completed ? 'bg-green-600' : 'bg-yellow-500' }}">
                                        {{ $task->is_completed ? 'Complete' : 'not complete' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-2 rounded-md hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
