<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);
const flash = computed(() => page.props.flash);
</script>

<template>
  <header class="nav">
    <strong>CRUD MVC</strong>
    <div v-if="user">
      Hola, {{ user.name }} &nbsp;
      <Link href="/logout" method="post" as="button" class="btn btn-sec">Cerrar sesión</Link>
    </div>
  </header>
  <main class="container">
    <div v-if="flash.success" class="alert">{{ flash.success }}</div>
    <slot />
  </main>
</template>