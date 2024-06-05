<div id="side-bar" class="bg-white fixed h-screen w-48 shadow flex flex-col gap-4 p-4 pt-20">
    <div class="text-xl">
        {{ __('Profile setting') }}
    </div>

    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        {{ __('Edit profile') }}
    </x-nav-link>

    <x-nav-link :href="route('profile.gallery')" :active="request()->routeIs('profile.gallery')">
        {{ __('Gallery') }}
    </x-nav-link>

    <x-nav-link :href="route('profile.password')" :active="request()->routeIs('profile.password')">
        {{ __('Update password') }}
    </x-nav-link>

    <x-nav-link :href="route('profile.payment')" :active="request()->routeIs('profile.payment')">
        {{ __('Payment') }}
    </x-nav-link>

    <x-nav-link :href="route('profile.account')" :active="request()->routeIs('profile.account')">
        {{ __('Account') }}
    </x-nav-link>
</div>
