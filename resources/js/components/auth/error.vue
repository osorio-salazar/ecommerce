<template>
    <div class="p-2 mb-2 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">¡Uups!</span> {{ message }}
    </div>
</template>

<script>
export default {
    props: ['message']
};
</script>

<style>
.mt-2 {
    margin-top: 0.5rem;
}
</style>
