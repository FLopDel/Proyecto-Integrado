<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
<!--                <Link href="/" class="text-blue-500 hover:underline" :class="{'font-bold inderline' : $page.url == '/'}">Home</Link>-->
<!--                <Link href="/" class="text-blue-500 hover:underline" :class="{'font-bold inderline' : $page.component == 'Home'}">Home</Link>-->
                <NavLink href="/" :active="$page.component === 'Home'">Home</NavLink>
            </li>
            <li>
<!--                <Link href="/users?foo=bar" class="text-blue-500 hover:underline" :class="{'font-bold inderline' : $page.url.startsWith('/users')}">Users</Link>-->
                <NavLink href="/users" :active="$page.component === 'Users'">Users</NavLink>
            </li>
            <li>
                <NavLink href="/dos" :active="$page.component === 'Dos'">Dos</NavLink>
            </li>
            <li><Link href="/settings" class="text-blue-500 hover:underline" :class="{'font-bold inderline' : $page.url == '/settings'}">Settings</Link></li>
            <li><Link href="/logout" method="post" as="button" class="text-blue-500 hover:underline" :data="{ foo: 'bar' }" >Log Out</Link></li>
        </ul>
    </nav>
</template>

<script>

import { Link } from "@inertiajs/vue3";
import NavLink  from "@/Shared/NavLink.vue";

export default {
    components: {NavLink, Link },
};
</script>
