<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

defineProps({ productos: Array });

const eliminar = (p) => {
  if (confirm(`¿Eliminar "${p.nombre}"?`)) {
    router.delete(`/productos/${p.id}`);
  }
};
</script>

<template>
  <Head title="Productos" />
  <AppLayout>
    <div class="card">
      <h2>Productos</h2>
      <Link href="/productos/create" class="btn">+ Nuevo producto</Link>

      <table>
        <thead>
          <tr><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <tr v-for="p in productos" :key="p.id">
            <td>{{ p.nombre }}</td>
            <td>${{ p.precio }}</td>
            <td>{{ p.stock }}</td>
            <td>
              <Link :href="`/productos/${p.id}/edit`" class="btn btn-sec">Editar</Link>
              &nbsp;
              <button class="btn btn-del" @click="eliminar(p)">Eliminar</button>
            </td>
          </tr>
          <tr v-if="productos.length === 0">
            <td colspan="4">No hay productos registrados.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>