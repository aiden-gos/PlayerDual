<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-white fixed h-screen w-48 shadow flex flex-col gap-4 p-4">
            <div class="text-xl">
                {{ __('Dashboard') }}
            </div>

            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Role manager') }}
            </x-nav-link>

            <x-nav-link :href="route('profile.password')" :active="request()->routeIs('profile.password')">
                {{ __('Game list manager') }}
            </x-nav-link>

            <x-nav-link :href="route('profile.account')" :active="request()->routeIs('profile.account')">
                {{ __('User manager ') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
