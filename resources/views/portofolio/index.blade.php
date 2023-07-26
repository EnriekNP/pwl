<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8">
        @csrf
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Portofolio List') }}
            </h2>
        </x-slot>
        <div class="container">
            <div class="flex items-center gap-4">
                <a href="{{ route('portofolio.create') }}"
                    class="bg-green-500 text-white border-none rounded-md py-2 px-4 hover:bg-green-300">Create</a>
            </div>
            @if (session('message'))
                <div class="alert alert-{{ session('message')['status'] }}" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __(session('message')['message']) }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row d-flex justify-content-center">
                <div class="p-3 bg-light">
                    <table class="table table-striped justify-content-center">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Portfolio Detail</th>
                                <th scope="col">Certificate</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($portofolios as $portofolio)
                                <tr>
                                    <td>{{ $portofolio->id }}</td>
                                    <td>
                                        <p> <b>Title:</b> {{ $portofolio->title }}</p>
                                        <p> <b>Contribution:</b> {{ $portofolio->contribution }}</p>
                                        <p> <b>Place:</b> {{ $portofolio->place }}</p>
                                        <p> <b>Description:</b> {{ $portofolio->description }}</p>
                                    </td>
                                    <td>
                                        <img width="200" height="150"
                                            src="{{ asset('storage/pictures/' . $portofolio->certificate) }}">
                                    </td>
                                    <td>
                                        <a href="{{ route('portofolio.edit', ['portofolio' => $portofolio->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form method="POST"
                                            action="{{ route('portofolio.destroy', $portofolio->id) }}"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
