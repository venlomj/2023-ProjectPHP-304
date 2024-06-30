<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Naam
                </th>
                <th scope="col" class="px-6 py-3">
                    Trainer
                </th>
                <th scope="col" class="px-6 py-3">
                    Rekeningnummer
                </th>
                <th scope="col" class="px-6 py-3">
                    Bedrag
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($paymentRegistrations as $payment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $payment->type }}
                </td>
                <td class="px-6 py-4">
                    {{ $payment->name }}
                </td>
                <td class="px-6 py-4">
                    {{$payment->name}}
                </td>
                <td class="px-6 py-4">
                    {{ $payment->price }}
                </td>
                <td class="px-6 py-4">

                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
