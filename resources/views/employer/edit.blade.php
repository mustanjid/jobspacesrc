<x-layout>
    <x-page-heading>Edit Employer - {{ $employer->name }}</x-page-heading>

    <x-forms.form method="POST" action="/employers/{{ $employer->id }}" enctype="multipart/form-data" class="mb-6">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-2 sm:px-6">
            <!-- Employer Name Field -->
            <div>
                <x-forms.input label="employer" name="employer" value="{{ old('employer', $employer->name) }}" />
            </div>

            <!-- Employer Logo Field -->
            <div>
                <x-forms.input label="logo" name="logo" type="file" />
                @if ($employer->logo)
                <div class="mt-2">
                    <p>Current Logo:</p>
                    <img src="{{ Storage::url($employer->logo) }}" alt="Current Logo" class="h-20 w-20 object-cover">
                </div>
                @endif
            </div>
        </div>
        <div class="mt-4 mb-6 px-6">
            <x-forms.button class="">Update Employer</x-forms.button>
        </div>
      
    </x-forms.form>
</x-layout>