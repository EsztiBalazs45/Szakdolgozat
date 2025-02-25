<script setup>
import Appoints from '@/Components/appoints.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

// Átirányítás a naptáras időpontfoglalás oldalra
const redirectToBooking = () => {
  router.visit(Appoints); // Az új oldal elérési útja
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Welcome back {{ $page.props.auth.user.name }}!
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <!-- Gomb az időpontfoglalás oldalra való átirányításhoz -->
          <button @click="redirectToBooking" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Időpontfoglalás
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>