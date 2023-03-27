<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Post Title</th>
                            <th class="px-4 py-2">Post Body</th>
                            {{-- @can('isAdmin','App\Models\Post') --}}
                            <th class="px-4 py-2">Edit</th>
                            <th class="px-4 py-2">Delete</th>
                            {{-- @endcan --}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                      <tr class="bg-gray-100">
                        <td class="border px-4 py-2">{{$post->title}}</td>
                        <td class="border px-4 py-2">{{$post->body}}</td>
                        {{-- @can('isAdmin','App\Models\Post') --}}
                        <td class="border px-4 py-2"><a href="{{url('/edit',$post->id)}}" class="text-blue-500 hover:text-blue-800">Edit</a></td>
                        <td class="border px-4 py-2"><a href="{{url('/delete',$post->id)}}" class="text-red-500 hover:text-red-800">Delete</a></td>
                        {{-- @endcan     --}}
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  
            </div>
        </div>
    </div>
</x-app-layout>
