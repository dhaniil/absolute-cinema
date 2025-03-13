<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b sticky top-0 bg-white/20 backdrop-blur-2xl">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            @auth
                @hasrole('super_admin')
                <flux:navbar class="-mb-px max-lg:hidden">
                    <flux:navbar.item icon="layout-grid" :href="route('adminpanel')" wire:navigate>
                        {{ __('Admin Panel') }}
                    </flux:navbar.item>
                </flux:navbar>
                @endhasrole
            @endauth
            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>
                    {{ __('Home') }}
                </flux:navbar.item>
            </flux:navbar>
            <flux:spacer />

            {{-- <flux:navbar class="mr-1.5 space-x-0.5 py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..."/>
                </flux:tooltip>
            </flux:navbar> --}}

            <livewire:search.index class="sm:hidden mx-auto" />


            @auth
            <!-- Desktop User Menu -->
            
            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    {{-- <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator /> --}}

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            @else
            <flux:navbar class="space-x-1">
                <flux:navbar.item :href="route('login')" :current="request()->routeIs('login')" wire:navigate>
                    {{ __('Login') }}
                </flux:navbar.item>
                <flux:navbar.item :href="route('register')" :current="request()->routeIs('register')" wire:navigate>
                    {{ __('Register') }}
                </flux:navbar.item>
            </flux:navbar>
            @endauth
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
            <livewire:search.index class="lg:hidden" />

            {{-- <a href="{{ route('dashboard') }}" class="ml-1 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
            </a> --}}
            @auth
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('adminpanel')" wire:navigate>
                    {{ __('Admin Panel') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
            @endauth
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="house" :href="route('home')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Home') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
