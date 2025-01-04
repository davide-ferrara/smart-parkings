<x-layout>
    <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

    <section>
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">

            <main class="flex justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Welcome to Smart Parking!
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Create your account to access convenient parking solutions in Reggio Calabria.
                        Register now to top up your balance, purchase tickets, and enjoy real-time updates on parking
                        availability through our interactive map. Parking made simple and hassle-free!
                    </p>

                    <form action="/register" method="POST" class="mt-8 grid grid-cols-6 gap-6">
                        @csrf
                        <div class="col-span-6">
                            <label for="FirstName" class="block text-sm font-medium text-gray-700">
                                Name
                            </label>

                            <input type="text" id="FirstName" name="name"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="Surname" class="block text-sm font-medium text-gray-700">
                                Surname
                            </label>

                            <input type="text" id="Surname" name="surname"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-gray-700"> Email </label>

                            <input type="email" id="Email" name="email"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        <div class="col-span-6">
                            <label for="Password" class="block text-sm font-medium text-gray-700"> Password </label>

                            <input type="password" id="Password" name="password"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                        </div>

                        {{--                        <div class="col-span-6 sm:col-span-3">
                            <label for="PasswordConfirmation" class="block text-sm font-medium text-gray-700">
                                Password Confirmation
                            </label>

                            <input
                                type="password"
                                id="PasswordConfirmation"
                                name="password_confirmation"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                            />
                        </div> --}}

                        {{--                        <div class="col-span-6">
                            <label for="MarketingAccept" class="flex gap-4">
                                <input
                                    type="checkbox"
                                    id="MarketingAccept"
                                    name="marketing_accept"
                                    class="size-5 rounded-md border-gray-200 bg-white shadow-sm"
                                />

                                <span class="text-sm text-gray-700">
                I want to receive emails about events, product updates and company announcements.
              </span>
                            </label>
                        </div> --}}

                        <div class="col-span-6">
                            <p class="text-sm text-gray-500">
                                By creating an account, you agree to our
                                <a href="#" class="text-gray-700 underline"> terms and conditions </a>
                                and
                                <a href="#" class="text-gray-700 underline">privacy policy</a>.
                            </p>
                        </div>

                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button
                                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                Create an account
                            </button>

                            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                                Already have an account?
                                <a href="/login" class="text-gray-700 underline">Log in</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>


</x-layout>
