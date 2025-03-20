<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import GithubLogo from "@/Components/Logo/GithubLogo.vue";
import GoogleLogo from "@/Components/Logo/GoogleLogo.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Log in" />

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Log in to your account</h2>
    </div>

    <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-[480px]">
      <form @submit.prevent="submit">
        <div>
          <InputLabel for="email" value="Email" />

          <TextInput id="email" type="email" class="mt-1" v-model="form.email" required autofocus
            autocomplete="username" />

          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
          <InputLabel for="password" value="Password" />

          <TextInput id="password" type="password" class="mt-1" v-model="form.password" required
            autocomplete="current-password" />

          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="flex items-center justify-between mt-5">
          <div class="flex gap-3">
            <div class="flex h-6 shrink-0 items-center">
              <Checkbox name="remember-me" v-model:checked="form.remember" />
            </div>
            <label for="remember-me" class="block text-sm/6 text-gray-900">Remember me</label>
          </div>

          <div class="text-sm/6">
            <Link v-if="canResetPassword" :href="route('password.request')"
              class="font-semibold text-indigo-600 hover:text-indigo-500">
            Forgot your password?
            </Link>
          </div>
        </div>

        <div class="mt-6">
          <PrimaryButton :class="{ 'opacity-25 cursor-not-allowed': form.processing }" :disabled="form.processing">
            Log in
          </PrimaryButton>
        </div>
      </form>

      <div class="relative mt-10">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
          <div class="w-full border-t border-gray-200" />
        </div>
        <div class="relative flex justify-center text-sm/6 font-medium">
          <span class="bg-white px-6 text-gray-900">Or continue with</span>
        </div>
      </div>

      <div class="mt-6 grid grid-cols-2 gap-4">
        <a :href="route('auth.socialite.redirect', { driver: 'google' })"
          class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:ring-transparent">
          <GoogleLogo class="h-8 w-auto" />
          <span class="text-sm/6 font-semibold">Google</span>
        </a>

        <a :href="route('auth.socialite.redirect', { driver: 'github' })"
          class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:ring-transparent">
          <GithubLogo class="h-8 w-auto" />
          <span class="text-sm/6 font-semibold">Github</span>
        </a>
      </div>
    </div>
  </GuestLayout>
</template>
