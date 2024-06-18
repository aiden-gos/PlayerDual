<x-app-layout>
    <x-slot name="header">
        <div id="side-bar" class="bg-gray-100 fixed h-screen w-60 shadow flex flex-col gap-4 p-4 pt-20">
            <div class="text-xl">
                {{ __('History') }}
            </div>

            <x-nav-link :href="route('following.list')" :active="request()->routeIs('following.list')">
                {{ __('Following players') }}
            </x-nav-link>

            <x-nav-link :href="route('donating.list')" :active="request()->routeIs('donating.list')">
                {{ __('Donate history') }}
            </x-nav-link>

            <x-nav-link :href="route('renting.list')" :active="request()->routeIs('renting.list')">
                {{ __('Rent history') }}
            </x-nav-link>
        </div>

    </x-slot>
    <div class="py-5 bg-white h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col gap-5 w-full justify-between">
                        {{-- User follwing --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 ">
                                            Player name
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Time
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Amount of money
                                        </th>
                                        <th scope="col" class="px-6 py-3 ">
                                            Message
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($donate as $item)
                                        <tr
                                            class="bg-white border-b">
                                            <td scope="row"
                                                class=" px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex flex-row gap-2 items-center">
                                                <img src="{{ $item->donated_user->avatar ?? '' }}" class="w-12 h-12 rounded-full">
                                                {{ $item->donated_user->name ?? "" }}
                                            </th>
                                            <td class="px-6 py-4 ">
                                                {{ $item->created_at }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                {{ $item->price }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                {{ $item->message }}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="py-5 px-20 ">
                            {{ $donate->links() }}
                        </div>
                        {{-- User follwing --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('stories.stories-show')
</x-app-layout>
