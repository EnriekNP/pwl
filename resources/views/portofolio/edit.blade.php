<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('portofolio.update', ['portofolio' => $portofolio->id]) }}"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $portofolio->title)"
                    required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="contribution" :value="__('Participation Type')" />
                <x-text-input id="contribution" name="contribution" type="text" class="mt-1 block w-full"
                    :value="old('contribution', $portofolio->contribution)" required autofocus autocomplete="contribution" />
                <x-input-error class="mt-2" :messages="$errors->get('contribution')" />
            </div>
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <textarea name="description" placeholder="{{ __('Description of the event') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $portofolio->description }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="place" :value="__('Place')" />
                <x-text-input id="place" name="place" type="text" class="mt-1 block w-full" :value="old('place', $portofolio->place)"
                    required autofocus autocomplete="place" />
                <x-input-error class="mt-2" :messages="$errors->get('place')" />
            </div>
            <div>
                <x-input-label for="certificate" :value="__('Certificate')" />
                <x-text-input id="certificate" name="certificate" type="file" class="mt-1 block w-full" required
                    autofocus autocomplete="certificate" />
                <x-input-error class="mt-2" :messages="$errors->get('certificate')" />
            </div>
            <x-primary-button class="mt-4">{{ __('save') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
