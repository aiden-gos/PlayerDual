<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-white fixed h-screen w-48 shadow flex flex-col gap-4 p-4">
            
            <div class="text-xl">
                {{ __('Profile setting') }}
            </div>

            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Edit profile') }}
            </x-nav-link>

            <x-nav-link :href="route('profile.password')" :active="request()->routeIs('profile.password')">
                {{ __('Update password') }}
            </x-nav-link>

            <x-nav-link :href="route('profile.account')" :active="request()->routeIs('profile.account')">
                {{ __('Account') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
