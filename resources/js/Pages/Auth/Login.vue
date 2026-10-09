<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ email: '', password: '' });

const enviar = () => {
  form.post('/login', { onFinish: () => form.reset('password') });
};
</script>

<template>
  <Head title="Iniciar sesión" />
  <div class="card login">
    <h2>Iniciar sesión</h2>
    <form @submit.prevent="enviar">
      <label>Correo</label>
      <input v-model="form.email" type="email" autofocus />
      <p v-if="form.errors.email" class="error">{{ form.errors.email }}</p>

      <label>Contraseña</label>
      <input v-model="form.password" type="password" />
      <p v-if="form.errors.password" class="error">{{ form.errors.password }}</p>

      <br />
      <button class="btn" :disabled="form.processing">Ingresar</button>
    </form>
  </div>
</template>