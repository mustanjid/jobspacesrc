<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        <div class="grid grid-cols-1 gap-4 px-2 sm:px-6 md:grid-cols-2">
            <!-- Left Column (Name, Email, Password) -->
            <div>
                <x-forms.input label="Name" name="name" />
            </div>
            <div>
                <x-forms.input label="Email" name="email" type="email" />
            </div>
            <div>
                <x-forms.input label="Password" name="password" type="password" />
            </div>
            <div>
                <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />
            </div>

            <!-- Right Column (Employer Name, Employer Logo) -->
            <div>
                <x-forms.input label="Employer Name" name="employer" />
            </div>
            <div>
                <x-forms.input label="Employer Logo" name="logo" type="file" />
            </div>
        </div>

        <div class="mb-6 mt-4 sm:mb-8">
            <x-forms.button>Create Account</x-forms.button>
        </div>

    </x-forms.form>
</x-layout>
