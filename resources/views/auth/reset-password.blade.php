<x-layout>
    <x-page-heading>Reset Password</x-page-heading>
    <div class="flex justify-center px-4">
        <x-forms.form method="POST" action="{{ route('reset-password.submit') }}"
            class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            @csrf
            <x-forms.input label="New Password" name="password" type="password" />
            <x-forms.input label="Confirm Password" name="password_confirmation" type="password" />
            @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <x-forms.button>Reset Password</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>