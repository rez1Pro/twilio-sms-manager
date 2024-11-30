<script setup lang="ts">
import { HomeIcon, InboxIcon, PaperAirplaneIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const navigation = [
    { name: 'Dashboard', href: route('dashboard'), icon: HomeIcon, current: route().current('dashboard') },
    { name: 'Send Messages', href: route('send-messages.index'), icon: PaperAirplaneIcon, current: route().current('send-messages.*') },
    { name: 'Recieved Messages', href: route('recieved-messages.index'), icon: InboxIcon, current: route().current('recieved-messages.*') },
];

const profileDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <!-- Navigation Header -->
        <nav
            class="sticky top-0 z-50 bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo and Brand -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center ml-0">
                            <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"
                                alt="Laravel Logo" class="h-8 w-auto transition-transform hover:scale-105" />
                        </div>
                    </div>

                    <!-- Right Navigation Items -->
                    <div class="flex items-center space-x-6">
                        <!-- Dark Mode Toggle -->
                        <button
                            class="p-2.5 rounded-full text-gray-500 hover:bg-gray-100 hover:text-indigo-600 active:bg-gray-200 transition-all duration-200 dark:text-gray-400 dark:hover:bg-gray-700/70 dark:hover:text-indigo-400 dark:active:bg-gray-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                        </button>
                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button @click="profileDropdown = !profileDropdown"
                                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:scale-105 active:scale-95">
                                <img class="h-10 w-10 rounded-full ring-2 ring-indigo-500/40 shadow-md"
                                    :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.name}&background=6366f1&color=fff`"
                                    alt="User avatar">
                            </button>
                            <!-- Dropdown Menu -->
                            <transition enter-active-class="transition ease-out duration-200"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <div v-show="profileDropdown"
                                    class="absolute right-0 mt-2 w-48 origin-top-right rounded-lg bg-white dark:bg-gray-800 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                        Your Profile
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                        Settings
                                    </a>
                                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                                    <Link :href="route('logout')" method="post"
                                        class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                    Sign out
                                    </Link>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar and Main Content -->
        <div class="flex h-[calc(100vh-4rem)]">
            <!-- Mobile Sidebar Overlay -->
            <div class="lg:hidden">
                <div class="fixed inset-0 z-40 flex">
                    <!-- Sidebar -->
                    <div class="relative flex w-full max-w-xs flex-1 flex-col bg-white dark:bg-gray-800">
                        <div class="h-0 flex-1 overflow-y-auto pt-5 pb-4">
                            <nav class="mt-5 px-2 space-y-2">
                                <template v-for="(item) in navigation" :key="item.name">
                                    <a :href="item.href" :class="[
                                        item.current
                                            ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white'
                                            : 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg'
                                    ]">
                                        <component :is="item.icon" class="mr-3 h-5 w-5" />
                                        {{ item.name }}
                                    </a>
                                </template>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Sidebar -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div
                    class="flex w-64 flex-col bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border-r border-gray-200 dark:border-gray-700">
                    <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
                        <nav class="mt-5 px-2 space-y-2">
                            <template v-for="(item) in navigation" :key="item.name">
                                <Link :href="item.href" :class="[
                                    item.current
                                        ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/40'
                                        : 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700',
                                    'group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-300'
                                ]">
                                <component :is="item.icon" class="mr-3 h-5 w-5" />
                                {{ item.name }}
                                </Link>
                            </template>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 overflow-auto">
                <main class="flex-1 relative py-6 px-4 sm:px-6 lg:px-8">
                    <!-- Page Header -->
                    <div class="mb-6">
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">
                            <slot name="header" />
                        </h1>
                    </div>

                    <!-- Main Content Slot -->
                    <div
                        class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-lg rounded-xl p-6 transition-all duration-300 hover:shadow-xl">
                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
