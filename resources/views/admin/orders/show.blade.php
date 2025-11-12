<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Detail for Order #021</h1>
                
                <div class="mb-6">
                    <p class="font-semibold">Customer: <span class="font-normal">Jasmine Fadhilah</span></p>
                    <p class="font-semibold">Email: <span class="font-normal">jasmine@gmail.com</span></p>
                    <p class="font-semibold">Total: <span class="font-normal">$134.99</span></p>
                    <p class="font-semibold">Status: <span class="text-red-600 font-bold">Pending</span></p>
                </div>

                <h2 class="text-xl font-semibold mb-3">Items Ordered</h2>
                <ul class="border p-4 rounded-lg">
                    <li>1x Headphone - $599.99</li>
                </ul>

                <h2 class="text-xl font-semibold mt-6 mb-3">Update Order Status</h2>
                <form method="POST" action="#">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="border p-2 rounded-lg">
                        <option value="Pending">Pending</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <button type="submit" class="ml-4 bg-green-500 text-white p-2 rounded-lg hover:bg-green-600">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
