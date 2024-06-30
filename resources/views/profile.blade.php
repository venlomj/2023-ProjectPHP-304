<x-hockeyclub-layout>
    <x-slot name="title">Profiel beheren</x-slot>
    <x-slot name="description">Hier bewerk je uw profiel</x-slot>
    <x-slot name="type">Persoonlijk</x-slot>
    <x-slot name="date">laatst bijgewerkt: 09/04/2023</x-slot>
    <x-slot name="knop"> <x-layout.3button></x-layout.3button> </x-slot>

     <div class="mt-10 ml-auto mr-auto sm:mt-0">
         <div class="">
             <div class="mt-5 md:mt-0">
                 <form action="#" method="POST">
                     <div class="overflow-hidden shadow sm:rounded-md">
                         <div class="bg-white px-4 py-5 sm:p-6">
                             <div class="grid grid-cols-12 gap-6">
                                 <div class="col-span-12 md:col-span-4">
                                     <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">Naam:</label>
                                     <input type="text" name="first-name" id="first_name" autocomplete="first_name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>
                                 <div class="col-span-12 md:col-span-4">
                                     <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Naam:</label>
                                     <input type="text" name="last_name" id="last_name" autocomplete="last_name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>

                                 <div class="col-span-12 md:col-span-4">
                                     <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Telefoonnummer:</label>
                                     <input type="text" name="phone_number" id="phone_number" autocomplete="phone_number" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>

                                 <div class="col-span-12 md:col-span-4">
                                     <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
                                     <input type="text" name="email" id="email" autocomplete="email" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>

                                 <div class="col-span-12 md:col-span-5 xl:col-span-4">
                                     <label for="street" class="block text-sm font-medium leading-6 text-gray-900">Straat:</label>
                                     <input type="text" name="street" id="street" autocomplete="street" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>

                                 <div class="col-span-12 md:col-span-5 xl:col-span-4">
                                     <label for="house_number" class="block text-sm font-medium leading-6 text-gray-900">Huisnummer:</label>
                                     <input type="text" name="house_number" id="house_number" autocomplete="house_number" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>
                                 <div class="col-span-12 md:col-span-5 xl:col-span-4">
                                     <label for="postal_code" class="block text-sm font-medium leading-6 text-gray-900">Postcode:</label>
                                     <input type="text" name="Stad" id="postal_code" autocomplete="postal_code" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>

                                 <div class="mt-4">
                                     <x-smod.form.select wire:model.defer="newUser.gender_id" id="gender_id">
                                         <option value="%">Geslacht</option>
                                         @foreach($genders as $gender)
                                             <option value="{{ $gender->id }}">{{ $gender->gender}}</option>
                                         @endforeach
                                     </x-smod.form.select>
                                     <x-smod.form.select wire:model.defer="newUser.role_id" id="role_id">
                                         <option value="%">Type gebruiker</option>
                                         @foreach($roles as $role)
                                             <option value="{{ $role->id }}">{{ $role->type }}</option>
                                         @endforeach
                                     </x-smod.form.select>
                                 </div>

{{--                                 <div class="col-span-12 md:col-span-3 xl:col-span-3">--}}
{{--                                     <label for="Huisnummer" class="block text-sm font-medium leading-6 text-gray-900">Huisnummer:</label>--}}
{{--                                     <input type="text" name="Huisnummer" id="Huisnummer" autocomplete="given-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">--}}
{{--                                 </div>--}}

{{--                                 <div class="col-span-12 md:col-span-3 xl:col-span-3">--}}
{{--                                     <label for="Postcode" class="block text-sm font-medium leading-6 text-gray-900">Postcode:</label>--}}
{{--                                     <input type="text" name="Postcode" id="Postcode" autocomplete="family-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">--}}
{{--                                 </div>--}}

{{--                                 <div class="col-span-12 md:col-span-6 xl:col-span-3">--}}
{{--                                     <label for="Rekeningnummer" class="block text-sm font-medium leading-6 text-gray-900">Rekeningnummer:</label>--}}
{{--                                     <input type="text" name="Rekeningnummer" id="Rekeningnummer" autocomplete="family-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">--}}
{{--                                 </div>--}}

                                 <div class="col-span-3 md:col-span-3 flex pt-8 pl-5">
                                     <label class="text-sm leading-6 inline-flex font-semibold text-blue-500" id="switch-1-label">
                                         Actief profiel:
                                     </label>
                                     <div class="flex h-6 items-center">
                                         <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                                         <button type="button" class="bg-gray-200 flex ml-3 w-8 inline-flex cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" role="switch" aria-checked="true" aria-labelledby="switch-1-label">
                                             <!-- Enabled: "translate-x-3.5", Not Enabled: "translate-x-0" -->
                                             <span aria-hidden="true" class="translate-x-0 h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out"></span>
                                         </button>
                                     </div>
                                 </div>


                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
</x-hockeyclub-layout>
