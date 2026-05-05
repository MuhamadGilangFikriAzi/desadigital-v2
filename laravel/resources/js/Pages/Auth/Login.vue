<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    nik: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <!-- Info akun demo -->
        <div class="mb-4 rounded-lg bg-blue-50 p-3 text-sm text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
            <p class="font-medium">💡 Akun Demo Staff Desa</p>
            <p>NIK: <code class="rounded bg-blue-100 px-1 dark:bg-blue-800">1234567890123456</code></p>
            <p>Password: <code class="rounded bg-blue-100 px-1 dark:bg-blue-800">admin123</code></p>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="nik" value="Nomor Induk Kependudukan (NIK)" />

                <TextInput
                    id="nik"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nik"
                    required
                    autofocus
                    autocomplete="username"
                    maxlength="16"
                    placeholder="Masukkan 16 digit NIK"
                />

                <InputError class="mt-2" :message="form.errors.nik" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Kata Sandi" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan kata sandi"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                        >Ingat saya</span
                    >
                </label>
            </div>

            <div class="mt-6 flex flex-col items-center gap-3">
                <PrimaryButton
                    class="w-full justify-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Masuk
                </PrimaryButton>

                <div class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-400">
                    <span>Belum punya akun?</span>
                    <Link
                        :href="route('register')"
                        class="font-medium text-indigo-600 underline hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-indigo-400"
                    >
                        Daftar di sini
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
