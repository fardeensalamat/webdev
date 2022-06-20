<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __("We have sent a temporary password to your mobile: {$mobile}. Please login using your new temporary password and change it.") }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        


            <div class="flex items-center  mt-4 ">
                <x-button>
                <a href="/login" class="btn btn-sm btn-primary ">Login</a>

                </x-button>
            </div>
        
    </x-auth-card>
</x-guest-layout>
