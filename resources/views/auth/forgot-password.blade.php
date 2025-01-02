<x-layout>
    <x-page-heading>Forgot Password</x-page-heading>
    <div class="flex justify-center px-4">
        <x-forms.form method="POST" action="{{ route('forgot-password.verify') }}"
            class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            @csrf
            <x-forms.input label="Email Address" name="email" type="email" />
            <x-forms.button>Submit</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>