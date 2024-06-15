<section>
    <header>
        <h2 class="text-2xl font-medium text-gray-900">
            {{ __('Actualizar contraseña') }}
        </h2>

        <p class="mt-1 text-2xl text-gray-600">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" novalidate>
        @csrf
        @method('put')

        <div>
            <x-input-label class="text-2xl" for="update_password_current_password" :value="__(' Password actual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full text-2xl" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-2xl" />
        </div>

        <div>
            <x-input-label class="text-2xl" for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full text-2xl" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-2xl" />
        </div>

        <div>
            <x-input-label class="text-2xl" for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full text-2xl" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-2xl" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="h-10 px-5 m-2 text-2xl text-blue-100 transition-colors duration-150 bg-blue-600 rounded-lg focus:shadow-outline hover:bg-purple-700">{{__('Actualizar') }}</x-primary-button>
            

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
