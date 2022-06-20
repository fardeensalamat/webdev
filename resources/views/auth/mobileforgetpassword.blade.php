<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? NSo problem. Just let us know your Bangladeshi mobile number and we will send
            you OTP code in your mobile.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('mobileForgetPasswordPost') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="mobile" :value="__('mobile')" />

                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" required
                    autofocus />
            </div>

                             <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Send Temporary Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>