<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    nik: '',
    name: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Daftar Akun" />

        <div class="mb-6 text-center">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Daftar Akun Baru</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Isi data diri Anda untuk mendaftar layanan desa
            </p>
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
                    autocomplete="off"
                    maxlength="16"
                    placeholder="16 digit NIK Anda"
                />

                <InputError class="mt-2" :message="form.errors.nik" />
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    NIK akan digunakan untuk login. Pastikan 16 digit dan sesuai KTP.
                </p>
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Nama Lengkap" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autocomplete="name"
                    placeholder="Nama sesuai KTP"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Kata Sandi" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Konfirmasi Kata Sandi"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ketik ulang kata sandi"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-6 flex flex-col items-center gap-3">
                <PrimaryButton
                    class="w-full justify-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Daftar
                </PrimaryButton>

                <div class="flex items-center gap-1 text-sm text-gray-600 dark:text-gray-400">
                    <span>Sudah punya akun?</span>
                    <Link
                        :href="route('login')"
                        class="font-medium text-indigo-600 underline hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-indigo-400"
                    >
                        Masuk di sini
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
