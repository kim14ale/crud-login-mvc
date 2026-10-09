<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const props = defineProps({ producto: Object });
const editando = !!props.producto;

const form = useForm({
  nombre: props.producto?.nombre ?? '',
  descripcion: props.producto?.descripcion ?? '',
  precio: props.producto?.precio ?? '',
  stock: props.producto?.stock ?? 0,
});

const guardar = () => {
  editando
    ? form.put(`/productos/${props.producto.id}`)
    : form.post('/productos');
};
</script>

<template>
  <Head :title="editando ? 'Editar producto' : 'Nuevo producto'" />
  <AppLayout>
    <div class="card">
      <h2>{{ editando ? 'Editar producto' : 'Nuevo producto' }}</h2>
      <form @submit.prevent="guardar">
        <label>Nombre</label>
        <input v-model="form.nombre" />
        <p v-if="form.errors.nombre" class="error">{{ form.errors.nombre }}</p>

        <label>Descripción</label>
        <textarea v-model="form.descripcion" rows="3"></textarea>

        <label>Precio</label>
        <input v-model="form.precio" type="number" step="0.01" />
        <p v-if="form.errors.precio" class="error">{{ form.errors.precio }}</p>

        <label>Stock</label>
        <input v-model="form.stock" type="number" />
        <p v-if="form.errors.stock" class="error">{{ form.errors.stock }}</p>

        <br />
        <button class="btn" :disabled="form.processing">Guardar</button>
        &nbsp;
        <Link href="/productos" class="btn btn-sec">Cancelar</Link>
      </form>
    </div>
  </AppLayout>
</template>