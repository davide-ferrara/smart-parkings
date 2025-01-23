<x-layout>

    <div class="flex-auto">
        <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->
        <section class="relative flex flex-wrap justify-center items-start h-screen lg:h-screen lg:items-start pt-10 lg:pt-20">
            <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
                <div class="mx-auto max-w-lg text-center">
                    <h1 class="text-2xl font-bold sm:text-3xl">Start parking today!</h1>

                    <p class="mt-4 text-gray-500">
                        Access your account to top up your balance, purchase parking tickets, and view real-time availability with our interactive map.
                        Convenient, fast, and secure experience smarter parking today.
                    </p>
                </div>

                <form action="/login" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
                @csrf
                    <div>
                        <label for="email" class="sr-only">Email</label>

                        <div class="relative">
                            <input
                                name="email"
                                type="email"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm "
                                placeholder="Enter email"
                            />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
              />
            </svg>
          </span>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>

                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="Enter password"
                            />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-4 text-gray-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
              />
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
              />
            </svg>
          </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            No account?
                            <a class="underline" href="/register">Register here</a>
                        </p>

                        <button
                            type="submit"
                            class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white hover:bg-gray-100 hover:text-blue-600"
                        >
                            Log in
                        </button>
                    </div>
                </form>
                <div>
                    @if (session('success'))
                        <p class="text-blue-600 font-medium text-m">{{ session('success') }}</p>
                    @endif

                    @if ($errors->any())
                        <div class="text-red-500 font-medium text-m">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

        </section>

    </div>

</x-layout>
