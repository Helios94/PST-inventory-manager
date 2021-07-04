<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Stock
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Owner/ Shareable
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Expiry
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($foods as $food)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
{{--                                                            @if(File::exists('/storage/'.$food->image))--}}
{{--                                                                <img class="h-10 w-10 rounded-full" src="{{ URL::asset('storage/'.$food->image) }}" alt="">--}}
{{--                                                            @else--}}
{{--                                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $food->name }}" alt="">--}}
{{--                                                            @endif--}}
                                                            <img class="h-10 w-10 rounded-full" src="{{ URL::asset('storage/'.$food->image) }}" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $food->name }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $food->description }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
{{--                                                            @if(File::exists(URL::asset('storage/'.$food->qrcode_path)))--}}
{{--                                                                <img class="h-10 w-10 rounded-full" src="{{ URL::asset('storage/'.$food->qrcode_path) }}" alt="">--}}
{{--                                                            @else--}}
{{--                                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $food->name }}" alt="">--}}
{{--                                                            @endif--}}
                                                            <img class="h-10 w-10 rounded-full" src="{{ URL::asset('storage/'.$food->qrcode_path) }}" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $food->barcode }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $food->storage->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $food->user->name }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $food->shareable ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                          {{ $food->shareable ? 'YES' : 'NO'}}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $food->expiry_date < Carbon\Carbon::today() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                          {{ $food->expiry_date}}
                                                        </span>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $food->expiry_date < Carbon\Carbon::today() ? 'Expired from :' : 'Expires in :' }}
                                                        {{ $food->expiry_date->diffInDays(Carbon\Carbon::today()) }} Days
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $food->quantity }} {{ $food->unit->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
